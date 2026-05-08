<?php

namespace App\Modules\Settings;

use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'Settings');
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
    }
}
