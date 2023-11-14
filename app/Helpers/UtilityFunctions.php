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
