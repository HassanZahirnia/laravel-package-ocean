<?php

use App\Livewire\Home;
use App\Livewire\TopLaravelPackages;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');

Route::get('/top-laravel-packages', TopLaravelPackages::class)->name('top-laravel-packages');

Route::feeds();
