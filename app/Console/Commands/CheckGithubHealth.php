<?php

namespace App\Console\Commands;

use App\Models\Package;
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

        progress(
            label: 'Checking Github health of packages',
            steps: $packages,
            callback: function ($package, $progress) use (&$unhealthyPackages) {
                $progress
                    ->label("{$package->name}")
                    ->hint("{$package->github}");

                $status = reportGithubRepositoryHealthStatus(extractRepoFromGithubUrl($package->github));

                if ($status !== true) {
                    $unhealthyPackages[] = [
                        'name' => $package->name,
                        'github' => $package->github,
                        'status' => $status,
                    ];
                }

                return true;
            },
            hint: 'This may take some time.',
        );

        if (count($unhealthyPackages) > 0) {
            note('Unhealthy packages:');

            foreach ($unhealthyPackages as $package) {
                warning("{$package['name']} ({$package['github']}): {$package['status']}");
            }
        } else {
            info('All packages are healthy!');
        }
    }
}
