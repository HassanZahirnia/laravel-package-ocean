<?php

use App\Livewire\Home;
use App\Livewire\Leaderboard;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');

Route::get('/top-laravel-packages', Leaderboard::class)->name('leaderboard');

Route::feeds();
