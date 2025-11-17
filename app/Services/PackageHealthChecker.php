<?php

namespace App\Services;

use App\Models\Package;

class PackageHealthChecker
{
    public const STATUS_ARCHIVED = 'archived';

    public const STATUS_DISABLED = 'disabled';

    public const STATUS_PRIVATE = 'private';

    public const STATUS_NOT_FOUND = 'not_found';

    public const STATUS_INACTIVE = 'inactive';

    public const STATUS_LARAVEL_INCOMPATIBLE = 'laravel_incompatible';

    public const STATUS_HEALTHY = 'healthy';

    public function checkPackageHealth(Package $package): array
    {
        $issues = [];

        // Check GitHub health and get last commit in one API call
        $githubResult = $this->checkGithubHealth($package);
        $githubStatus = $githubResult['status'];
        $lastCommit = $githubResult['last_commit'];

        if ($githubStatus !== self::STATUS_HEALTHY) {
            $issues[] = [
                'type' => 'github',
                'status' => $githubStatus,
                'message' => $this->getGithubStatusMessage($githubStatus),
                'last_commit' => $lastCommit,
            ];
        }

        // Check Laravel compatibility - only for Laravel packages
        if ($package->package_type === 'laravel-package' && ! empty($package->laravel_dependency_versions)) {
            if (! $package->isCompatibleWithLaravelActiveVersions()) {
                $issues[] = [
                    'type' => 'laravel_compatibility',
                    'status' => self::STATUS_LARAVEL_INCOMPATIBLE,
                    'message' => $this->getLaravelCompatibilityMessage($package),
                    'last_commit' => $lastCommit,
                ];
            }
        }

        // If healthy, still return last commit data
        if (empty($issues) && $lastCommit) {
            $issues[] = [
                'type' => 'info',
                'status' => self::STATUS_HEALTHY,
                'message' => 'Package is healthy',
                'last_commit' => $lastCommit,
            ];
        }

        return $issues;
    }

    public function checkGithubHealth(Package $package): array
    {
        $repository = extractRepoFromGithubUrl($package->github);

        if (! $repository) {
            return ['status' => self::STATUS_NOT_FOUND, 'last_commit' => null];
        }

        try {
            $result = reportGithubRepositoryHealthStatus($repository);

            // Handle the new array response
            if (is_array($result)) {
                $status = $result['status'];
                $lastCommit = $result['last_commit'];

                if ($status === true) {
                    return ['status' => self::STATUS_HEALTHY, 'last_commit' => $lastCommit];
                }

                // Map the string status to our constants
                $mappedStatus = match ($status) {
                    'archived' => self::STATUS_ARCHIVED,
                    'disabled' => self::STATUS_DISABLED,
                    'private' => self::STATUS_PRIVATE,
                    'not found' => self::STATUS_NOT_FOUND,
                    'inactive' => self::STATUS_INACTIVE,
                    default => $status,
                };

                return ['status' => $mappedStatus, 'last_commit' => $lastCommit];
            }

            // Fallback for boolean response (backward compatibility)
            if ($result === true) {
                return ['status' => self::STATUS_HEALTHY, 'last_commit' => null];
            }

            return ['status' => $result, 'last_commit' => null];
        } catch (\Exception $e) {
            // If GitHub API fails, consider it healthy to avoid false positives
            return ['status' => self::STATUS_HEALTHY, 'last_commit' => null];
        }
    }

    public function getGithubStatusMessage(string $status): string
    {
        return match ($status) {
            self::STATUS_ARCHIVED => 'Repository is archived',
            self::STATUS_DISABLED => 'Repository is disabled',
            self::STATUS_PRIVATE => 'Repository is private',
            self::STATUS_NOT_FOUND => 'Repository not found',
            self::STATUS_INACTIVE => 'The repository has not been updated in the last year',
            default => $status,
        };
    }

    public function getLaravelCompatibilityMessage(Package $package): string
    {
        $activeVersions = fetchActiveLaravelVersions();
        $maxVersion = $package->maximumCompatibleLaravelVersion();

        if ($maxVersion) {
            return "Only supports Laravel up to v{$maxVersion}, not compatible with latest versions (".implode(', ', array_slice($activeVersions, -2)).')';
        }

        return 'Not compatible with any active Laravel versions';
    }

    public function isPackageHealthy(Package $package): bool
    {
        return empty($this->checkPackageHealth($package));
    }

    public function getHealthStatusBadge(string $status): array
    {
        return match ($status) {
            self::STATUS_ARCHIVED => ['color' => 'danger', 'label' => 'Archived'],
            self::STATUS_DISABLED => ['color' => 'danger', 'label' => 'Disabled'],
            self::STATUS_PRIVATE => ['color' => 'danger', 'label' => 'Private'],
            self::STATUS_NOT_FOUND => ['color' => 'danger', 'label' => 'Not Found'],
            self::STATUS_INACTIVE => ['color' => 'warning', 'label' => 'Inactive'],
            self::STATUS_LARAVEL_INCOMPATIBLE => ['color' => 'info', 'label' => 'Laravel Incompatible'],
            default => ['color' => 'gray', 'label' => $status],
        };
    }
}
