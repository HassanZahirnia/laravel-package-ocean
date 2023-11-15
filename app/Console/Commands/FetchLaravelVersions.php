<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FetchLaravelVersions extends Command
{
    protected $signature = 'app:fetch-laravel-versions';

    protected $description = 'Fetches active Laravel versions from the API and updates the cache';

    public function handle()
    {
        $activeVersions = fetchActiveLaravelVersions();
        $this->info('Laravel versions updated to '.implode(', ', $activeVersions));
    }
}
