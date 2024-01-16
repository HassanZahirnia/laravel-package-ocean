<?php

namespace App\Console\Commands;

use App\Models\Package;
use Illuminate\Console\Command;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\progress;

class UpdatePackages extends Command
{
    protected $signature = 'ocean:update-packages';

    protected $description = 'Update all packages';

    public function handle()
    {
        $updateAll = confirm(
            label: 'Do you want to update all packages (or only those not updated in the past day?)',
            default: false,
            yes: 'All packages',
            no: 'Not updated in past day',
        );

        $packages = Package::query()
            ->when($updateAll === false, function ($query) {
                $yesterday = now()->subDay();

                return $query->where('updated_at', '<', $yesterday);
            })
            ->orderBy('id')
            ->get();

        progress(
            label: 'Updating packages',
            steps: $packages,
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
