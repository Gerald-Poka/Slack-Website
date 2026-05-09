<?php

use App\Providers\AppServiceProvider;

return [
    AppServiceProvider::class,
    App\Modules\Theme\ThemeServiceProvider::class,
    App\Modules\CMS\CMSServiceProvider::class,
    App\Modules\PageBuilder\PageBuilderServiceProvider::class,
    App\Modules\Media\MediaServiceProvider::class,
    App\Modules\Settings\SettingsServiceProvider::class,
    App\Modules\Auth\AuthServiceProvider::class,
    App\Modules\Plugin\PluginServiceProvider::class,
    App\Modules\Navigation\NavigationServiceProvider::class,
    App\Modules\Forms\FormsServiceProvider::class,
    App\Modules\Audit\AuditServiceProvider::class,
    App\Modules\SEO\SEOServiceProvider::class,
];
