<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Admin Routes (To be protected by auth/roles later)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Placeholder routes for other roles
    Route::get('/editor', function() { return "Editor Dashboard"; })->name('editor');
    Route::get('/contributor', function() { return "Contributor Dashboard"; })->name('contributor');
    Route::get('/viewer', function() { return "Viewer Dashboard"; })->name('viewer');
});
