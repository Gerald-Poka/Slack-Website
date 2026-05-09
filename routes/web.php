<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Modules\Auth\Controllers\DashboardController;
use App\Modules\Auth\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes (To be protected by auth/roles later)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/switch-package', function(\Illuminate\Http\Request $request) {
        session(['active_package' => $request->package]);
        return back();
    })->name('admin.switch_package');
    
    // Placeholder routes for other roles
    Route::get('/editor', function() { return "Editor Dashboard"; })->name('editor');
    Route::get('/contributor', function() { return "Contributor Dashboard"; })->name('contributor');
    Route::get('/viewer', function() { return "Viewer Dashboard"; })->name('viewer');
});
