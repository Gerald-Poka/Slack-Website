<?php

namespace App\Modules\PageBuilder;

use Illuminate\Support\ServiceProvider;

class PageBuilderServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'PageBuilder');
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
    }
}
