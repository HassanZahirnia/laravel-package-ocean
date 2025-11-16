<?php

namespace App\Console\Commands;

use App\Models\Package;
use App\Services\PackageHealthChecker;
use Illuminate\Console\Command;

use function Laravel\Prompts\info;
use function Laravel\Prompts\note;
use function Laravel\Prompts\progress;
use function Laravel\Prompts\warning;

class CheckGithubHealth extends Command
{
    protected $signature = 'ocean:check-github-health';

    protected $description = 'Check Github health of packages';

    public function handle()
    {
        $packages = Package::query()
            ->orderBy('id')
            ->get();

        $unhealthyPackages = [];
        $checker = new PackageHealthChecker;

        progress(
            label: 'Checking package health',
            steps: $packages,
            callback: function ($package, $progress) use (&$unhealthyPackages, $checker) {
                $progress
                    ->label("{$package->name}")
                    ->hint("{$package->github}");

                $issues = $checker->checkPackageHealth($package);

                if (! empty($issues)) {
                    $unhealthyPackages[] = [
                        'name' => $package->name,
                        'github' => $package->github,
                        'issues' => $issues,
                    ];
                }

                return true;
            },
            hint: 'This may take some time.',
        );

        if (count($unhealthyPackages) > 0) {
            note('Unhealthy packages:');

            foreach ($unhealthyPackages as $package) {
                warning("{$package['name']} ({$package['github']}):");

                foreach ($package['issues'] as $issue) {
                    $this->line("  • {$issue['message']}");
                }
            }
        } else {
            info('All packages are healthy!');
        }
    }
}
