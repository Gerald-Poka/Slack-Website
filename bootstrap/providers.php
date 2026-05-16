<?php

use App\Providers\AppServiceProvider;

return [
    AppServiceProvider::class,
    App\Modules\CMS\CMSServiceProvider::class,
    App\Modules\Settings\SettingsServiceProvider::class,
    App\Modules\Auth\AuthServiceProvider::class,
];
