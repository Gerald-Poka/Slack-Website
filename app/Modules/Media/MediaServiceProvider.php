<?php

namespace App\Modules\Media;

use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'Media');
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
    }
}
