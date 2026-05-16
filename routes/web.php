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

    // Settings Routes
    Route::get('/settings', [\App\Modules\Settings\Controllers\SettingsController::class, 'index'])->name('admin.settings.index');
    Route::post('/settings', [\App\Modules\Settings\Controllers\SettingsController::class, 'update'])->name('admin.settings.update');

    // Theme Routes
    Route::get('/theme', [\App\Modules\Settings\Controllers\ThemeController::class, 'index'])->name('admin.theme.index');
    Route::post('/theme', [\App\Modules\Settings\Controllers\ThemeController::class, 'update'])->name('admin.theme.update');

    // Page Builder Routes
    Route::get('/pagebuilder', [\App\Modules\Settings\Controllers\PageBuilderController::class, 'index'])->name('admin.pagebuilder.index');
    Route::get('/pagebuilder/{id}', [\App\Modules\Settings\Controllers\PageBuilderController::class, 'edit'])->name('admin.pagebuilder.edit');
    Route::post('/pagebuilder/{id}/add-section', [\App\Modules\Settings\Controllers\PageBuilderController::class, 'addSection'])->name('admin.pagebuilder.add_section');
    
    // Placeholder routes for other roles
    Route::get('/editor', function() { return "Editor Dashboard"; })->name('editor');
    Route::get('/contributor', function() { return "Contributor Dashboard"; })->name('contributor');
    Route::get('/viewer', function() { return "Viewer Dashboard"; })->name('viewer');
});
