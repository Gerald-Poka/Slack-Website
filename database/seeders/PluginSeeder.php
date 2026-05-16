<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Settings\Models\Plugin;

class PluginSeeder extends Seeder
{
    public function run()
    {
        // Define only the 3 main "Workspace" packages
        $mainPackages = [
            [
                'name' => 'core/cms',
                'label' => 'Content Center (CMS)',
                'icon' => 'ph-newspaper',
                'version' => '1.0.0',
                'entry_class' => 'App\Modules\CMS\CMSServiceProvider',
                'status' => 'active',
            ],
            [
                'name' => 'core/settings',
                'label' => 'System Architect (Settings)',
                'icon' => 'ph-gear',
                'version' => '1.0.0',
                'entry_class' => 'App\Modules\Settings\SettingsServiceProvider',
                'status' => 'active',
            ],
            [
                'name' => 'core/auth',
                'label' => 'Control Center (Security)',
                'icon' => 'ph-shield-check',
                'version' => '1.0.0',
                'entry_class' => 'App\Modules\Auth\AuthServiceProvider',
                'status' => 'active',
            ],
        ];

        foreach ($mainPackages as $pkg) {
            Plugin::updateOrCreate(['name' => $pkg['name']], $pkg);
            
            // Create a permission for this package
            $slug = str_replace('core/', '', $pkg['name']);
            \Spatie\Permission\Models\Permission::findOrCreate('access module ' . $slug);
        }

        // Clean up: Deactivate any other modules that were previously registered as packages
        Plugin::whereNotIn('name', array_column($mainPackages, 'name'))->delete();
    }
}
