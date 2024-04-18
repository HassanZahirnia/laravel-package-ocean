<?php

use Illuminate\Support\Facades\Schedule;

// Update the Laravel versions every day
Schedule::command('app:fetch-laravel-versions')->daily();

// Generate the sitemap every day
Schedule::command('sitemap:generate')->daily();
