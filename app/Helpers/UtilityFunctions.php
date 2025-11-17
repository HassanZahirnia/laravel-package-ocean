<?php

use App\Models\Category;
use Carbon\Carbon;
use Composer\Semver\Constraint\ConstraintInterface;
use Composer\Semver\Constraint\MultiConstraint;
use Composer\Semver\Intervals;
use Composer\Semver\Semver;
use Composer\Semver\VersionParser;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

function isValidVersionConstraint($constraintString): bool
{
    $versionParser = new VersionParser;

    try {
        $constraint = $versionParser->parseConstraints($constraintString);
        Intervals::get($constraint);

        return true;
    } catch (Exception $e) {
        return false;
    }
}

function fetchActiveLaravelVersions()
{
    return cache()->remember('active_laravel_versions', now()->addDay(), function () {
        try {
            $response = Http::retry(3, 100, function ($exception) {
                return $exception instanceof ConnectionException;
            })
                ->get('https://laravelversions.com/api/versions');

            if ($response->successful()) {
                return extractActiveVersionsFromLaravelVersions($response);
            } else {
                // If the primary source fails, try the fallback source
                return fetchVersionsFromEndOfLife();
            }
        } catch (Exception $e) {
            // If there's an exception, try the fallback source
            Log::error('Error fetching active Laravel versions: '.$e->getMessage());

            return fetchVersionsFromEndOfLife();
        }
    });
}

function extractActiveVersionsFromLaravelVersions($response)
{
    $data = $response->json('data');
    $activeVersions = collect($data)
        ->where('status', 'active')
        ->pluck('latest')
        ->sort()
        ->values()
        ->toArray();

    return empty($activeVersions) ? ['11.0.0'] : $activeVersions;
}

function fetchVersionsFromEndOfLife()
{
    $response = Http::get('https://endoflife.date/api/laravel.json');

    if ($response->successful()) {
        $data = $response->json();
        $today = now();

        $activeVersions = collect($data)
            ->filter(function ($version) use ($today) {
                // Check if the support date is still valid
                return $today->lessThan($version['support']);
            })
            ->pluck('latest')
            ->sort()
            ->values()
            ->toArray();

        return empty($activeVersions) ? ['11.0.0'] : $activeVersions;
    }

    return ['11.0.0']; // Default fallback if both sources fail
}

function latestActiveLaravelVersion()
{
    return collect(fetchActiveLaravelVersions())->last();
}

function isCompatibleWithLaravelActiveVersions($dependencies): bool
{
    $activeVersions = fetchActiveLaravelVersions();

    foreach ($dependencies as $versionConstraint) {
        // Preprocess the version constraint
        $preprocessedConstraint = preprocessVersionConstraint($versionConstraint);

        foreach ($activeVersions as $activeVersion) {
            if (Semver::satisfies($activeVersion, $preprocessedConstraint)) {
                return true; // Found a compatible version
            }
        }
    }

    return false; // No compatible versions found
}

function preprocessVersionConstraint($constraint)
{
    // Handle range constraints like '5.0 - 5.8' and convert them into '>=5.0 <5.9'
    $constraint = preg_replace_callback('/(\d+\.\d+) - (\d+\.\d+)/', function ($matches) {
        // Increment the minor version of the upper bound
        $upperBound = explode('.', $matches[2]);
        $upperBound[1] = strval(intval($upperBound[1]) + 1);

        return '>= '.$matches[1].' < '.implode('.', $upperBound);
    }, $constraint);

    // Handle wildcard constraints like ^10.*
    $constraint = str_replace('.*', '', $constraint);

    // Split the constraint on '||', add comparator if missing, then join back
    return implode(' || ', array_map(function ($part) {
        $part = trim($part);
        if (! preg_match('/^[><=~^]/', $part)) {
            return '^'.$part; // Add '^' if no comparator is present
        }

        return $part;
    }, explode('||', $constraint)));
}

function isVersionSatisfiedByConstraint($version, ConstraintInterface $constraint)
{
    if ($constraint instanceof MultiConstraint) {
        // For MultiConstraint, check if any sub-constraint is satisfied
        foreach ($constraint->getConstraints() as $subConstraint) {
            if (isVersionSatisfiedByConstraint($version, $subConstraint)) {
                return true;
            }
        }

        return false;
    } else {
        // For a regular Constraint, directly check for satisfaction
        return Semver::satisfies($version, $constraint);
    }
}

function formatSemverVersion($version)
{
    // Remove any pre-release suffixes
    $version = preg_replace('/\-dev|\-alpha|\-beta|\-RC/', '', $version);

    // Keep only the first three parts of the version
    $parts = explode('.', $version);
    if (count($parts) > 3) {
        $version = implode('.', array_slice($parts, 0, 3));
    }

    return $version;
}

function isGithubRepositoryHealthy($repository): bool
{
    $response = Http::timeout(60)->connectTimeout(60)->withHeaders([
        'Authorization' => 'Bearer '.config('services.github.token'),
    ])->get('https://api.github.com/repos/'.$repository);

    if ($response->failed()) {
        return false;
    }

    $data = $response->json();

    if ($data['archived']) {
        return false;
    }

    if ($data['disabled']) {
        return false;
    }

    if ($data['private']) {
        return false;
    }

    if (data_get($data, 'message') === 'Not Found') {
        return false;
    }

    if (now()->subYear()->greaterThan($data['pushed_at'])) {
        return false;
    }

    return true;
}

function reportGithubRepositoryHealthStatus($repository): array|bool
{
    $response = Http::timeout(10)->connectTimeout(10)->withHeaders([
        'Authorization' => 'Bearer '.config('services.github.token'),
    ])->get('https://api.github.com/repos/'.$repository);

    if ($response->failed()) {
        return ['status' => 'not found', 'last_commit' => null];
    }

    $data = $response->json();

    $lastCommit = $data['pushed_at'] ?? null;

    if ($data['archived']) {
        return ['status' => 'archived', 'last_commit' => $lastCommit];
    }

    if ($data['disabled']) {
        return ['status' => 'disabled', 'last_commit' => $lastCommit];
    }

    if ($data['private']) {
        return ['status' => 'private', 'last_commit' => $lastCommit];
    }

    if (data_get($data, 'message') === 'Not Found') {
        return ['status' => 'not found', 'last_commit' => null];
    }

    if (now()->subYear()->greaterThan($data['pushed_at'])) {
        return ['status' => 'inactive', 'last_commit' => $lastCommit];
    }

    return ['status' => true, 'last_commit' => $lastCommit];
}

// Get author and name of repo from the github link
// Example: https://github.com/spatie/once -> spatie/once
function extractRepoFromGithubUrl($url): ?string
{
    // Use regular expression to match the GitHub URL pattern
    $pattern = '/https?:\/\/github\.com\/([^\/]+)\/([^\/]+)/i';

    // Execute the regular expression match
    if (preg_match($pattern, $url, $matches)) {
        // If a match is found, return the author and repo name in the desired format
        return $matches[1].'/'.$matches[2];
    }

    // Return null if no match is found
    return null;
}

function fetchGithubStars($url): int
{
    $githubData = Http::retry(3, 100, function ($exception) {
        return $exception instanceof ConnectionException;
    })
        ->timeout(60)
        ->connectTimeout(60)
        ->withHeaders([
            'Authorization' => 'Bearer '.config('services.github.token'),
        ])
        ->get('https://api.github.com/repos/'.extractRepoFromGithubUrl($url));

    if ($githubData->failed()) {
        return 0;
    }

    return $githubData->json('stargazers_count');
}

function getNpmData($npm): array
{
    $npmData = Http::retry(3, 100, function ($exception) {
        return $exception instanceof ConnectionException;
    })
        ->timeout(60)
        ->connectTimeout(60)
        ->get('https://registry.npmjs.org/'.$npm);

    if ($npmData->failed()) {
        return [];
    }

    $first_release_at = $npmData->json('time.created');
    $latest_release_at = $npmData->json('time.modified');

    return [
        'first_release_at' => $first_release_at ? Carbon::parse($first_release_at)->format('Y-m-d H:i:s') : null,
        'latest_release_at' => $latest_release_at ? Carbon::parse($latest_release_at)->format('Y-m-d H:i:s') : null,
    ];
}

function getPackagistData($composer): array
{
    $packagistData = Http::retry(3, 100, function ($exception) {
        return $exception instanceof ConnectionException;
    })
        ->timeout(60)
        ->connectTimeout(60)
        ->get('https://packagist.org/packages/'.$composer.'.json');

    $minimalPackagistData = Http::retry(3, 100, function ($exception) {
        return $exception instanceof ConnectionException;
    })
        ->timeout(60)
        ->connectTimeout(60)
        ->get('https://repo.packagist.org/p2/'.$composer.'.json');

    if ($packagistData->failed() || $minimalPackagistData->failed()) {
        return [];
    }

    $first_release_at = $packagistData->json('package.time');
    $latest_release_at = extractLatestReleaseFromPackagistData($minimalPackagistData->json());
    $laravel_dependency_versions = extractLaravelDependencyVersions($minimalPackagistData->json());

    return [
        'first_release_at' => $first_release_at ? Carbon::parse($first_release_at)->format('Y-m-d H:i:s') : null,
        'latest_release_at' => $latest_release_at ? Carbon::parse($latest_release_at)->format('Y-m-d H:i:s') : null,
        'laravel_dependency_versions' => $laravel_dependency_versions,
    ];
}

function extractLatestReleaseFromPackagistData($minimalPackagistData): ?string
{
    if (! isset($minimalPackagistData['packages']) || empty($minimalPackagistData['packages'])) {
        return null;
    }

    $packages = array_values($minimalPackagistData['packages'])[0];
    foreach ($packages as $release) {
        if (strpos($release['version'], 'dev') === false &&
            strpos($release['version'], 'alpha') === false &&
            strpos($release['version'], 'beta') === false &&
            strpos($release['version'], 'rc') === false) {
            return $release['time'];
        }
    }

    return null;
}

function extractLaravelDependencyVersions($minimalPackagistData): array
{
    $latestRelease = extractLatestReleaseForDependencies($minimalPackagistData);
    if (! $latestRelease) {
        return [];
    }

    $supportedVersions = [];
    $dependencies = array_merge(
        $latestRelease['require'] ?? [],
        $latestRelease['require-dev'] ?? []
    );

    foreach ($dependencies as $dependency => $version) {
        if ((strpos($dependency, 'illuminate/') === 0 || $dependency === 'laravel/framework') &&
            $version !== '*' && isValidVersionConstraint($version)) {
            $supportedVersions[] = $version;
        }
    }

    return array_values(array_unique($supportedVersions));
}

function extractLatestReleaseForDependencies($minimalPackagistData): ?array
{
    if (! isset($minimalPackagistData['packages']) || empty($minimalPackagistData['packages'])) {
        return null;
    }

    $packages = array_values($minimalPackagistData['packages'])[0];
    foreach ($packages as $release) {
        if (strpos($release['version'], 'dev') === false &&
            strpos($release['version'], 'alpha') === false &&
            strpos($release['version'], 'beta') === false &&
            strpos($release['version'], 'rc') === false) {
            return $release;
        }
    }

    return null;
}

function getGithubPackageMetadata(string $githubUrl): array
{
    $repository = extractRepoFromGithubUrl($githubUrl);

    if (! $repository) {
        return [];
    }

    $baseUrl = 'https://api.github.com/repos/'.$repository;

    // --- 1) Base repo data -----------------------------------------------
    $repoResponse = Http::retry(3, 100, fn ($e) => $e instanceof ConnectionException)
        ->timeout(60)
        ->connectTimeout(60)
        ->withHeaders([
            'Authorization' => 'Bearer '.config('services.github.token'),
            'Accept' => 'application/vnd.github+json',
        ])
        ->get($baseUrl);

    $repoData = $repoResponse->successful() ? $repoResponse->json() : null;

    // --- 2) composer.json (optional – may not exist) ---------------------
    $composerData = null;

    try {
        $composerResponse = Http::retry(3, 100, fn ($e) => $e instanceof ConnectionException)
            ->timeout(60)
            ->connectTimeout(60)
            ->withHeaders([
                'Authorization' => 'Bearer '.config('services.github.token'),
                'Accept' => 'application/vnd.github.raw+json',
            ])
            ->get($baseUrl.'/contents/composer.json'); // 404 is OK – we handle it

        if ($composerResponse->successful()) {
            // If we requested raw JSON there is no base64 wrapping
            $body = $composerResponse->body();

            try {
                $composerData = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
            } catch (Throwable $e) {
                // Some setups may still return the "content" + base64; try that as a fallback
                $json = $composerResponse->json();

                if (isset($json['content'])) {
                    try {
                        $decoded = base64_decode($json['content'], true);
                        $composerData = json_decode($decoded, true, 512, JSON_THROW_ON_ERROR);
                    } catch (Throwable $ignored) {
                        $composerData = null;
                    }
                }
            }
        }
    } catch (RequestException $e) {
        // If it's a 404, that's fine – just means no composer.json.
        // Anything else (401, 500, etc.) we *could* log but we don't crash.
        if (optional($e->response)->status() !== 404) {
            // Optional: Log it instead of rethrowing
            // Log::warning('Error fetching composer.json: '.$e->getMessage());
        }
        $composerData = null;
    }

    // --- 3) README snippet (optional) ------------------------------------
    $readmeSnippet = null;

    try {
        $readmeResponse = Http::retry(3, 100, fn ($e) => $e instanceof ConnectionException)
            ->timeout(60)
            ->connectTimeout(60)
            ->withHeaders([
                'Authorization' => 'Bearer '.config('services.github.token'),
                // raw markdown so we can feed real text to the model
                'Accept' => 'application/vnd.github.raw+json',
            ])
            ->get($baseUrl.'/readme');

        if ($readmeResponse->successful()) {
            $text = $readmeResponse->body();
            // Trim to a sane size so we don’t overload the LLM
            $readmeSnippet = Str::limit($text, 4000, '');
        }
    } catch (RequestException $e) {
        // 404 README? Also fine – just leave readme_snip null
        if (optional($e->response)->status() !== 404) {
            // Optional: Log::warning('Error fetching README: '.$e->getMessage());
        }
        $readmeSnippet = null;
    }

    return [
        'github_url' => $githubUrl,
        'repository' => $repository,
        'owner' => Str::before($repository, '/'),
        'name' => Str::after($repository, '/'),
        'repo' => $repoData,
        'composer' => $composerData,
        'readme_snip' => $readmeSnippet,
    ];
}

function aiGeneratePackageFormFields(array $githubMetadata): array
{
    $context = [
        'repo' => [
            'full_name' => data_get($githubMetadata, 'repo.full_name'),
            'description' => data_get($githubMetadata, 'repo.description'),
            'topics' => data_get($githubMetadata, 'repo.topics', []),
            'language' => data_get($githubMetadata, 'repo.language'),
        ],
        'composer' => [
            'name' => data_get($githubMetadata, 'composer.name'),
            'description' => data_get($githubMetadata, 'composer.description'),
            'keywords' => data_get($githubMetadata, 'composer.keywords', []),
            'require' => data_get($githubMetadata, 'composer.require', []),
        ],
        'readme' => $githubMetadata['readme_snip'] ?? null,
    ];

    $jsonContext = json_encode($context, JSON_PRETTY_PRINT);

    $categoryNames = Category::query()
        ->orderBy('name')
        ->pluck('name')
        ->filter()
        ->values()
        ->all();

    $categoriesList = implode(', ', $categoryNames);

    $allowedPackageTypes = [
        'laravel-package',
        'php-package',
        'npm-package',
        'mac-app',
        'windows-app',
        'all-operating-systems-app',
        'ide-extension',
    ];
    $packageTypeOptions = implode(', ', $allowedPackageTypes);

    $prompt = <<<PROMPT
You help maintain the Package Ocean directory for developer tools and libraries.

You will receive metadata for a software package. It might be:
- a Laravel or PHP library (with composer.json),
- an NPM/JavaScript package,
- or another kind of tool.
Some projects will not have composer.json.

You will see:
- GitHub repository description and topics,
- optional composer.json info,
- a README snippet.

Carefully READ this data and identify the real purpose and main features.

Return JSON with EXACTLY this shape:

{
  "name": "...",
  "description": "...",
  "category": "...",
  "package_type": "...",
  "npm": "..."
}

Rules:

- "name":
  - 2–40 characters.
  - Title Case (capitalize main words).
  - No emojis or quotes.
  - Choose a concise, human-friendly display name.
  - You may use:
    - the main heading in the README,
    - or the repository name,
    - or the package name from composer.json or package.json.
  - Do NOT include vendor/namespace prefixes like "john-doe/" or "@vendor/".

- "description":
  - One short sentence that explains what the package DOES in concrete terms.
  - Start with a strong verb: "Tracks", "Logs", "Monitors", "Stores", "Manages", "Generates", "Sends", "Displays", etc.
  - Mention 1–3 specific aspects taken from the README (e.g. "HTTP requests", "analytics dashboard", "API endpoints", "bot detection", "IP geolocation").
  - Keep it as short as possible while still being clear and useful.
  - Maximum 100 characters.
  - Starts with a capital letter.
  - Ends with a period.
  - Avoid generic phrases like:
    - "Provides analytics for Laravel applications."
    - "Simple and easy to use."
    - "Dashboard and API for tracking traffic."
  - Do NOT use buzzwords like "best", "top", "ultimate", "must-have".
  - No emojis.

- "category":
  - Choose the single MOST appropriate value from this list:
    {$categoriesList}

- "package_type":
  - One of: {$packageTypeOptions}.
  - If a composer.json exists and the package clearly integrates with Laravel, use "laravel-package".
  - If a composer.json exists but it's a generic PHP library, use "php-package".
  - If installation instructions focus on "npm install", "pnpm add" or "yarn add", prefer "npm-package".
  - Use the desktop or IDE types only when clearly indicated.

- "npm":
  - The NPM package name (e.g. "vue-i18n" or "@vendor/pkg") if the main installation is via npm/pnpm/yarn.
  - Otherwise null.

Return ONLY the JSON object. No extra text, no markdown, no code fences.

Here is the package metadata:

{$jsonContext}
PROMPT;

    // Generic envs so the project is portable:
    $baseUrl = rtrim(
        env('AI_API_URL', env('OPENAI_URL', 'http://127.0.0.1:1234/v1')),
        '/'
    );
    $model = env('AI_MODEL', env('OPENAI_MODEL', 'gpt-4.1-mini'));
    $apiKey = env('AI_API_KEY', env('OPENAI_API_KEY', 'dummy-key'));

    $response = Http::withHeaders([
        'Authorization' => 'Bearer '.$apiKey,
        'Content-Type' => 'application/json',
    ])->post($baseUrl.'/chat/completions', [
        'model' => $model,
        'messages' => [
            [
                'role' => 'system',
                'content' => 'You are a strict JSON generator. Always return valid JSON only.',
            ],
            [
                'role' => 'user',
                'content' => $prompt,
            ],
        ],
        'temperature' => 0.1,
        'max_tokens' => 512,
    ]);

    if ($response->failed()) {
        return [
            'name' => null,
            'description' => null,
            'category' => null,
            'composer' => data_get($githubMetadata, 'composer.name'),
            'package_type' => null,
            'npm' => null,
        ];
    }

    $content = data_get($response->json(), 'choices.0.message.content', '');
    $jsonString = extractJsonObjectFromString($content);

    try {
        $data = json_decode($jsonString, true, 512, JSON_THROW_ON_ERROR);
    } catch (Throwable $e) {
        return [
            'name' => null,
            'description' => null,
            'category' => null,
            'composer' => data_get($githubMetadata, 'composer.name'),
            'package_type' => null,
            'npm' => null,
        ];
    }

    // --- Post-process to fit your rules ----------------------------------

    $name = isset($data['name']) ? Str::of($data['name'])->squish() : null;

    $description = isset($data['description']) ? Str::of($data['description'])->squish() : null;
    if ($description) {
        $description = Str::limit($description, 100, '');
        $description = ucfirst($description);
        if (! Str::endsWith($description, '.')) {
            $description .= '.';
        }
    }

    $category = isset($data['category']) ? trim($data['category']) : null;
    $aiPackageType = isset($data['package_type']) ? trim($data['package_type']) : null;
    $aiNpm = isset($data['npm']) ? trim($data['npm']) : null;

    $composerName = data_get($githubMetadata, 'composer.name');
    $requires = data_get($githubMetadata, 'composer.require', []);

    // Decide final package_type + npm using metadata first, AI as a fallback
    $packageType = null;
    $npm = null;

    if ($composerName) {
        // Composer-based project => decide Laravel vs plain PHP
        $deps = array_keys(is_array($requires) ? $requires : []);

        $isLaravel = collect($deps)->contains(function (string $dep) {
            return $dep === 'laravel/framework'
                || str_starts_with($dep, 'illuminate/')
                || str_contains($dep, 'laravel');
        });

        $packageType = $isLaravel ? 'laravel-package' : 'php-package';
        $npm = null; // composer-driven libs must not set npm
    } else {
        // No composer.json => trust AI more for npm / app / IDE etc.
        if (in_array($aiPackageType, $allowedPackageTypes, true)) {
            $packageType = $aiPackageType;
        } else {
            // Most non-composer repos you'll feed in will be JS libs
            $packageType = 'npm-package';
        }

        $npm = $aiNpm ?: null;
    }

    return [
        'name' => $name,
        'description' => $description,
        'category' => $category,
        'composer' => $composerName,
        'package_type' => $packageType,
        'npm' => $npm,
    ];
}

function extractJsonObjectFromString(string $text): string
{
    // If it's already plain JSON, just return it
    $trimmed = trim($text);
    if (str_starts_with($trimmed, '{') && str_ends_with($trimmed, '}')) {
        return $trimmed;
    }

    // Try to find the first { ... } block
    if (preg_match('/\{.*\}/s', $text, $matches)) {
        return $matches[0];
    }

    // Fallback: return as-is (will likely fail json_decode and be handled upstream)
    return $text;
}
