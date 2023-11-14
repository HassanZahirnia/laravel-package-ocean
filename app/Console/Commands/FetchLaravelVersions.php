<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchLaravelVersions extends Command
{
    protected $signature = 'app:fetch-laravel-versions';

    protected $description = 'Fetches active Laravel versions from the API and updates the cache';

    public function handle()
    {
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

            cache()->put('active_laravel_versions', $activeVersions, now()->addDay());

            $this->info('Laravel versions updated successfully!');
        } else {
            $this->error('Failed to fetch Laravel versions from the API.');
        }
    }
}
