<?php

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Set the api/query?github=${url} route and check if the package exists in the database by the Github url
Route::get('/query', function (Request $request) {
    $package = Package::where('github', $request->string('github'))->first();

    // If the package exists, return the exists key as true, else return false
    if ($package) {
        return [
            'exists' => true,
        ];
    }

    return [
        'exists' => false,
    ];
})->middleware('throttle:60,1');
