<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:fetch-laravel-versions')->daily();
