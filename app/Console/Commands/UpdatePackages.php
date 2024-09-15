<?php

namespace App\Console\Commands;

use App\Models\Package;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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
                return $query->where('updated_at', '<', now()->subDay());
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

                try {
                    $package->updateStars();

                    $package->updateReleaseDatesAndDependencies();

                    $package->touch();
                } catch (\Exception $e) {
                    $this->error("Failed to update package {$package->name}: {$e->getMessage()}");
                    Log::error("Failed to update package {$package->name}", ['exception' => $e]);

                    return false;
                }

                return true;
            },
            hint: 'This may take some time.',
        );
    }
}
