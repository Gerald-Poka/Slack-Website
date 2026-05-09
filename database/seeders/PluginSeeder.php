<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Plugin\Models\Plugin;

class PluginSeeder extends Seeder
{
    public function run()
    {
        $modulesPath = app_path('Modules');
        $modules = array_filter(glob($modulesPath . '/*'), 'is_dir');

        foreach ($modules as $modulePath) {
            $moduleName = basename($modulePath);
            
            // Standardize icons for core modules
            $icons = [
                'CMS' => 'ph-newspaper',
                'Auth' => 'ph-lock',
                'Media' => 'ph-image',
                'PageBuilder' => 'ph-layout',
                'Settings' => 'ph-gear',
                'Theme' => 'ph-palette',
                'SEO' => 'ph-globe',
                'Forms' => 'ph-note-pencil',
                'Audit' => 'ph-list-checks',
                'Navigation' => 'ph-list',
            ];

            $plugin = Plugin::updateOrCreate(
                ['name' => 'core/' . strtolower($moduleName)],
                [
                    'label' => $moduleName,
                    'icon' => $icons[$moduleName] ?? 'ph-package',
                    'version' => '1.0.0',
                    'entry_class' => "App\\Modules\\{$moduleName}\\{$moduleName}ServiceProvider",
                    'status' => 'active',
                ]
            );

            // Create a permission for this package if it doesn't exist
            \Spatie\Permission\Models\Permission::findOrCreate('access module ' . strtolower($moduleName));
        }
    }
}
