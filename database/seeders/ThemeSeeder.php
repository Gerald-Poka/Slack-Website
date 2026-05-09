<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Theme\Models\Theme;
use App\Modules\Theme\Models\ThemeSetting;

class ThemeSeeder extends Seeder
{
    public function run(): void
    {
        // Default themes
        $themes = [
            ['name' => 'corporate',  'label' => 'Corporate Blue',      'description' => 'Professional corporate website theme with clean lines and a blue palette.', 'is_active' => 1, 'is_default' => 1, 'is_system' => 1, 'version' => '1.0.0'],
            ['name' => 'academic',   'label' => 'Academic Portal',     'description' => 'University and school-oriented theme with navigation-heavy layout.',        'is_active' => 0, 'is_default' => 0, 'is_system' => 1, 'version' => '1.0.0'],
            ['name' => 'minimal',    'label' => 'Minimal Clean',       'description' => 'Lightweight, whitespace-driven theme for marketing landing pages.',         'is_active' => 0, 'is_default' => 0, 'is_system' => 1, 'version' => '1.0.0'],
        ];

        foreach ($themes as $theme) {
            Theme::updateOrCreate(['name' => $theme['name']], $theme);
        }

        // Corporate theme settings
        $corporateTheme = Theme::where('name', 'corporate')->first();
        if ($corporateTheme) {
            $settings = [
                ['key' => 'primary_color',    'value' => '#1E3A5F', 'type' => 'color',  'group' => 'colors',     'label' => 'Primary Color',      'sort_order' => 1],
                ['key' => 'secondary_color',  'value' => '#2E86AB', 'type' => 'color',  'group' => 'colors',     'label' => 'Secondary Color',    'sort_order' => 2],
                ['key' => 'accent_color',     'value' => '#F4A261', 'type' => 'color',  'group' => 'colors',     'label' => 'Accent Color',       'sort_order' => 3],
                ['key' => 'background_color', 'value' => '#FFFFFF', 'type' => 'color',  'group' => 'colors',     'label' => 'Background Color',   'sort_order' => 4],
                ['key' => 'text_color',       'value' => '#1A1A2E', 'type' => 'color',  'group' => 'colors',     'label' => 'Text Color',         'sort_order' => 5],
                ['key' => 'heading_font',     'value' => 'Playfair Display', 'type' => 'font', 'group' => 'typography', 'label' => 'Heading Font',   'sort_order' => 1],
                ['key' => 'body_font',        'value' => 'DM Sans', 'type' => 'font',   'group' => 'typography', 'label' => 'Body Font',          'sort_order' => 2],
                ['key' => 'base_font_size',   'value' => '16px',    'type' => 'string', 'group' => 'typography', 'label' => 'Base Font Size',     'sort_order' => 3],
                ['key' => 'layout_type',      'value' => 'boxed',   'type' => 'select', 'group' => 'layout',     'label' => 'Layout Type',        'sort_order' => 1],
                ['key' => 'container_width',  'value' => '1280',    'type' => 'integer','group' => 'layout',     'label' => 'Container Width (px)','sort_order' => 2],
                ['key' => 'header_style',     'value' => 'fixed',   'type' => 'select', 'group' => 'layout',     'label' => 'Header Style',       'sort_order' => 3],
                ['key' => 'nav_style',        'value' => 'horizontal','type' => 'select','group' => 'navigation', 'label' => 'Navigation Style',   'sort_order' => 1],
                ['key' => 'footer_columns',   'value' => '3',       'type' => 'integer','group' => 'layout',     'label' => 'Footer Columns',     'sort_order' => 4],
                ['key' => 'border_radius',    'value' => '8px',     'type' => 'string', 'group' => 'layout',     'label' => 'Border Radius',      'sort_order' => 5],
            ];

            foreach ($settings as $setting) {
                ThemeSetting::updateOrCreate(
                    ['theme_id' => $corporateTheme->id, 'key' => $setting['key']],
                    $setting
                );
            }
        }
    }
}
