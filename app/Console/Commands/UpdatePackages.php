<?php

namespace App\Console\Commands;

use App\Models\Package;
use Illuminate\Console\Command;

use function Laravel\Prompts\progress;
use function Laravel\Prompts\text;

class UpdatePackages extends Command
{
    protected $signature = 'ocean:update-packages';

    protected $description = 'Update all packages';

    public function handle()
    {
        $id = text(
            label: 'Do you want to start from a specific package ID? (leave empty to start from the beginning)',
            validate: function ($id) {
                if ($id === '') { // Allow empty input to pass validation
                    return null;
                }

                return is_numeric($id) ? null : 'Please enter a valid numeric ID.';
            }
        );

        $packages = Package::query()
            ->when($id, function ($query, $id) {
                return $query->where('id', '>=', $id);
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
