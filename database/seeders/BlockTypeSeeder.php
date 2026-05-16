<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlockTypeSeeder extends Seeder
{
    public function run()
    {
        $types = [
            [
                'name' => 'hero',
                'label' => 'Hero Section',
                'category' => 'layout',
                'description' => 'A large banner section with a heading, subtext, and background image.',
                'icon' => 'ph-article',
                'schema' => json_encode(['fields' => ['title', 'subtitle', 'button_text', 'image']]),
                'default_props' => json_encode([
                    'title' => 'Welcome to our Website',
                    'subtitle' => 'Building amazing experiences without code.',
                    'button_text' => 'Get Started',
                    'image' => ''
                ]),
                'renderer_class' => 'App\Modules\PageBuilder\Renderers\HeroRenderer',
                'is_active' => true,
            ],
            [
                'name' => 'features',
                'label' => 'Feature List',
                'category' => 'content',
                'description' => 'A grid of features with icons and descriptions.',
                'icon' => 'ph-grid-four',
                'schema' => json_encode(['fields' => ['items']]),
                'default_props' => json_encode([
                    'items' => [
                        ['title' => 'Fast Performance', 'desc' => 'Optimized for speed.', 'icon' => 'ph-lightning'],
                        ['title' => 'Responsive', 'desc' => 'Looks great on all devices.', 'icon' => 'ph-device-mobile'],
                    ]
                ]),
                'renderer_class' => 'App\Modules\PageBuilder\Renderers\FeatureRenderer',
                'is_active' => true,
            ],
            [
                'name' => 'cta',
                'label' => 'Call to Action',
                'category' => 'layout',
                'description' => 'A simple bar with a title and a button to drive conversions.',
                'icon' => 'ph-megaphone',
                'schema' => json_encode(['fields' => ['title', 'button_text']]),
                'default_props' => json_encode([
                    'title' => 'Ready to build your site?',
                    'button_text' => 'Join Now'
                ]),
                'renderer_class' => 'App\Modules\PageBuilder\Renderers\CTARenderer',
                'is_active' => true,
            ],
        ];

        foreach ($types as $type) {
            DB::table('block_types')->updateOrInsert(['name' => $type['name']], $type);
        }
    }
}
