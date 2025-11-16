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

        // Check GitHub health
        $githubStatus = $this->checkGithubHealth($package);
        if ($githubStatus !== self::STATUS_HEALTHY) {
            $issues[] = [
                'type' => 'github',
                'status' => $githubStatus,
                'message' => $this->getGithubStatusMessage($githubStatus),
            ];
        }

        // Check Laravel compatibility - only for Laravel packages
        if ($package->package_type === 'laravel-package' && ! empty($package->laravel_dependency_versions)) {
            if (! $package->isCompatibleWithLaravelActiveVersions()) {
                $issues[] = [
                    'type' => 'laravel_compatibility',
                    'status' => self::STATUS_LARAVEL_INCOMPATIBLE,
                    'message' => $this->getLaravelCompatibilityMessage($package),
                ];
            }
        }

        return $issues;
    }

    public function checkGithubHealth(Package $package): string
    {
        $repository = extractRepoFromGithubUrl($package->github);

        if (! $repository) {
            return self::STATUS_NOT_FOUND;
        }

        try {
            $status = reportGithubRepositoryHealthStatus($repository);

            if ($status === true) {
                return self::STATUS_HEALTHY;
            }

            // Map the string status to our constants
            return match ($status) {
                'archived' => self::STATUS_ARCHIVED,
                'disabled' => self::STATUS_DISABLED,
                'private' => self::STATUS_PRIVATE,
                'not found' => self::STATUS_NOT_FOUND,
                'inactive' => self::STATUS_INACTIVE,
                default => $status,
            };
        } catch (\Exception $e) {
            // If GitHub API fails, consider it healthy to avoid false positives
            return self::STATUS_HEALTHY;
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
