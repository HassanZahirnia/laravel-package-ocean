<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearHealthCheckCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'health-check:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear health check scanning state and results';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Cache::forget('health_check_state');
        Cache::forget('health_check_results');

        $this->components->info('Health check state and results cleared successfully.');

        return self::SUCCESS;
    }
}
