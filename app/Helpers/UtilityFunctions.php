<?php

use Carbon\Carbon;
use Composer\Semver\Intervals;
use Composer\Semver\VersionParser;
use Illuminate\Support\Facades\Http;

function isValidVersionConstraint($constraintString): bool
{
    $versionParser = new VersionParser();

    try {
        $constraint = $versionParser->parseConstraints($constraintString);
        Intervals::get($constraint);

        return true;
    } catch (\Exception $e) {
        return false;
    }
}

function fetchActiveLaravelVersions()
{
    return cache()->remember('active_laravel_versions', now()->addDay(), function () {
        $response = Http::get('https://laravelversions.com/api/versions');

        if ($response->successful()) {
            $data = $response->json('data');

            $activeVersions = collect($data)
                ->where('status', 'active') // Filter for active versions
                ->pluck('latest') // Extract the 'latest' property
                ->sort() // Sort the versions
                ->values()
                ->toArray();

            // If active versions is empty, we'll default to '10.0.0' as a fallback
            if (empty($activeVersions)) {
                $activeVersions = ['10.0.0'];
            }

            return $activeVersions;
        }

        return ['10.0.0'];
    });
}

function isGithubRepositoryHealthy($repository): bool
{
    $response = Http::get('https://api.github.com/repos/'.$repository);

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

    if (now()->subMonths(8)->greaterThan($data['pushed_at'])) {
        return false;
    }

    return true;
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

function getNpmData($npm): array
{
    $npmData = Http::get('https://registry.npmjs.org/'.$npm);
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
    $packagistData = Http::get('https://packagist.org/packages/'.$composer.'.json');
    $minimalPackagistData = Http::get('https://repo.packagist.org/p2/'.$composer.'.json');
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
