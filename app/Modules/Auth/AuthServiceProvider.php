<?php

namespace App\Modules\Auth;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'Auth');
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
    }
}
