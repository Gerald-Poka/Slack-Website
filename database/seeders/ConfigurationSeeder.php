<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Settings\Models\Configuration;

class ConfigurationSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            [
                'group' => 'general',
                'key' => 'site_name',
                'value' => 'Slack Website',
                'type' => 'string',
                'label' => 'Site Name',
                'description' => 'The title of your website.',
                'sort_order' => 1,
            ],
            [
                'group' => 'general',
                'key' => 'site_description',
                'value' => 'A professional modular monolith platform.',
                'type' => 'text',
                'label' => 'Site Description',
                'description' => 'A short description of your website for SEO.',
                'sort_order' => 2,
            ],
            [
                'group' => 'general',
                'key' => 'contact_email',
                'value' => 'admin@example.com',
                'type' => 'email',
                'label' => 'Contact Email',
                'description' => 'The main email address for contact.',
                'sort_order' => 3,
            ],
            [
                'group' => 'general',
                'key' => 'site_logo',
                'value' => '',
                'type' => 'url',
                'label' => 'Site Logo URL',
                'description' => 'The URL of your website logo.',
                'sort_order' => 4,
            ],
            // Theme Customization
            [
                'group' => 'theme',
                'key' => 'primary_color',
                'value' => '#2196F3',
                'type' => 'color',
                'label' => 'Primary Color',
                'description' => 'Main color for buttons and links.',
                'sort_order' => 10,
            ],
            [
                'group' => 'theme',
                'key' => 'secondary_color',
                'value' => '#263238',
                'type' => 'color',
                'label' => 'Secondary Color',
                'description' => 'Color for accents and footers.',
                'sort_order' => 11,
            ],
            [
                'group' => 'theme',
                'key' => 'heading_font',
                'value' => 'Inter',
                'type' => 'string',
                'label' => 'Heading Font',
                'description' => 'Font family for all headings.',
                'sort_order' => 12,
            ],
            [
                'group' => 'theme',
                'key' => 'body_font',
                'value' => 'Inter',
                'type' => 'string',
                'label' => 'Body Font',
                'description' => 'Font family for body text.',
                'sort_order' => 13,
            ],
        ];

        foreach ($settings as $setting) {
            Configuration::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
