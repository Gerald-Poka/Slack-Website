<?php

namespace App\Modules\CMS;

use Illuminate\Support\ServiceProvider;

class CMSServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'CMS');
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
    }
}
