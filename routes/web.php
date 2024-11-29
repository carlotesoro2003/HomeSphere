<?php

use App\Http\Controllers\PropertyController;
use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;

// Welcome page route
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Redirect authenticated users to properties index
Route::get('/properties', [PropertyController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('properties.index');

// Resource routes for properties (only accessible by authenticated users)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('properties', PropertyController::class)->except('index'); // Exclude 'index' since it's already defined above
});

// Redirect the root `/` to `properties.index` if the user is logged in
Route::get('/', function () {
    return redirect()->route('properties.index');
})->middleware('auth');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/statistics', [StatsController::class, 'index'])->name('stats.stats');
});

// Authentication routes (e.g., login, register)
require __DIR__.'/auth.php';
