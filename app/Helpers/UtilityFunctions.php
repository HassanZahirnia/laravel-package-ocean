<?php

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

    if ($data['message'] === 'Not Found') {
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
