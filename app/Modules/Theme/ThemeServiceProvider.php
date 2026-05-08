<?php

namespace App\Modules\Theme;

use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Load views with a namespace
        $this->loadViewsFrom(__DIR__ . '/Views', 'Theme');
        
        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
    }
}
