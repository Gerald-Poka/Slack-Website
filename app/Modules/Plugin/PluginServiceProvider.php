<?php

namespace App\Modules\Plugin;

use Illuminate\Support\ServiceProvider;

class PluginServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'Plugin');
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
    }
}
