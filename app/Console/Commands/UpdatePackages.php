<?php

namespace App\Console\Commands;

use App\Models\Package;
use Illuminate\Console\Command;

use function Laravel\Prompts\progress;

class UpdatePackages extends Command
{
    protected $signature = 'ocean:update-packages';

    protected $description = 'Update all packages';

    public function handle()
    {
        progress(
            label: 'Updating packages',
            steps: Package::all(),
            callback: function ($package, $progress) {
                $progress
                    ->label("{$package->name}")
                    ->hint("{$package->github}");

                $package->updateStars();

                $package->updateReleaseDatesAndDependencies();

                return true;
            },
            hint: 'This may take some time.',
        );
    }
}
