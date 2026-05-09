<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Settings\Models\Configuration;

class ConfigurationSeeder extends Seeder
{
    public function run(): void
    {
        $configs = [
            // General
            ['group' => 'general', 'key' => 'site_name',           'value' => 'Slack Website',          'type' => 'string',  'is_public' => 1, 'label' => 'Site Name',           'description' => 'Displayed in browser tab and header logo area.',         'sort_order' => 1],
            ['group' => 'general', 'key' => 'site_tagline',        'value' => 'Built with Laravel',     'type' => 'string',  'is_public' => 1, 'label' => 'Site Tagline',        'description' => 'Short tagline shown in hero sections and metadata.',      'sort_order' => 2],
            ['group' => 'general', 'key' => 'site_description',    'value' => '',                       'type' => 'text',    'is_public' => 1, 'label' => 'Site Description',    'description' => 'Default meta description for the homepage.',              'sort_order' => 3],
            ['group' => 'general', 'key' => 'contact_email',       'value' => 'admin@example.com',      'type' => 'email',   'is_public' => 0, 'label' => 'Contact Email',       'description' => 'Primary contact address used by contact forms.',          'sort_order' => 4],
            ['group' => 'general', 'key' => 'contact_phone',       'value' => '',                       'type' => 'string',  'is_public' => 1, 'label' => 'Contact Phone',       'description' => 'Phone number shown in footer and contact section.',       'sort_order' => 5],
            ['group' => 'general', 'key' => 'contact_address',     'value' => '',                       'type' => 'text',    'is_public' => 1, 'label' => 'Physical Address',    'description' => 'Street address for map blocks and footer.',               'sort_order' => 6],
            ['group' => 'general', 'key' => 'logo_image_id',       'value' => NULL,                     'type' => 'integer', 'is_public' => 1, 'label' => 'Logo Image',          'description' => 'Media ID of the site logo.',                             'sort_order' => 7],
            ['group' => 'general', 'key' => 'favicon_image_id',    'value' => NULL,                     'type' => 'integer', 'is_public' => 1, 'label' => 'Favicon Image',       'description' => 'Media ID of the browser favicon.',                       'sort_order' => 8],
            ['group' => 'general', 'key' => 'timezone',            'value' => 'Africa/Dar_es_Salaam',   'type' => 'string',  'is_public' => 0, 'label' => 'Timezone',            'description' => 'Application timezone.',                                  'sort_order' => 9],
            ['group' => 'general', 'key' => 'date_format',         'value' => 'd M Y',                  'type' => 'string',  'is_public' => 1, 'label' => 'Date Format',         'description' => 'PHP date format string.',                                'sort_order' => 10],
            // SEO
            ['group' => 'seo',     'key' => 'meta_title_format',   'value' => '%s | {site_name}',       'type' => 'string',  'is_public' => 0, 'label' => 'Meta Title Format',   'description' => 'Use %s for page title, {site_name} for site name.',      'sort_order' => 1],
            ['group' => 'seo',     'key' => 'default_meta_desc',   'value' => '',                       'type' => 'text',    'is_public' => 0, 'label' => 'Default Meta Desc',   'description' => 'Fallback meta description when page has none.',          'sort_order' => 2],
            ['group' => 'seo',     'key' => 'google_analytics_id', 'value' => '',                       'type' => 'string',  'is_public' => 0, 'label' => 'Google Analytics ID', 'description' => 'G-XXXXXXXXXX format for GA4.',                           'sort_order' => 3],
            ['group' => 'seo',     'key' => 'google_tag_manager',  'value' => '',                       'type' => 'string',  'is_public' => 0, 'label' => 'Google Tag Manager',  'description' => 'GTM-XXXXXXX container ID.',                              'sort_order' => 4],
            ['group' => 'seo',     'key' => 'robots_txt',          'value' => "User-agent: *\nAllow: /", 'type' => 'text',    'is_public' => 0, 'label' => 'robots.txt Content',  'description' => 'Content served at /robots.txt.',                         'sort_order' => 5],
            ['group' => 'seo',     'key' => 'sitemap_enabled',     'value' => '1',                      'type' => 'boolean', 'is_public' => 0, 'label' => 'Sitemap Enabled',     'description' => 'Auto-generate and serve sitemap.xml.',                   'sort_order' => 6],
            // Mail
            ['group' => 'mail',    'key' => 'from_name',           'value' => 'Slack Website',          'type' => 'string',  'is_public' => 0, 'label' => 'From Name',           'description' => 'Display name for outgoing emails.',                      'sort_order' => 1],
            ['group' => 'mail',    'key' => 'from_address',        'value' => 'noreply@example.com',    'type' => 'email',   'is_public' => 0, 'label' => 'From Address',        'description' => 'Sender address for outgoing emails.',                    'sort_order' => 2],
            ['group' => 'mail',    'key' => 'reply_to',            'value' => '',                       'type' => 'email',   'is_public' => 0, 'label' => 'Reply-To',            'description' => 'Optional reply-to address.',                             'sort_order' => 3],
            // Social
            ['group' => 'social',  'key' => 'facebook_url',        'value' => '',                       'type' => 'url',     'is_public' => 1, 'label' => 'Facebook URL',        'description' => 'Full URL of the Facebook page.',                         'sort_order' => 1],
            ['group' => 'social',  'key' => 'twitter_handle',      'value' => '',                       'type' => 'string',  'is_public' => 1, 'label' => 'Twitter Handle',      'description' => '@handle without the @ symbol.',                          'sort_order' => 2],
            ['group' => 'social',  'key' => 'instagram_url',       'value' => '',                       'type' => 'url',     'is_public' => 1, 'label' => 'Instagram URL',       'description' => '',                                                       'sort_order' => 3],
            ['group' => 'social',  'key' => 'linkedin_url',        'value' => '',                       'type' => 'url',     'is_public' => 1, 'label' => 'LinkedIn URL',        'description' => '',                                                       'sort_order' => 4],
            ['group' => 'social',  'key' => 'youtube_url',         'value' => '',                       'type' => 'url',     'is_public' => 1, 'label' => 'YouTube URL',         'description' => '',                                                       'sort_order' => 5],
            // Features
            ['group' => 'features','key' => 'blog_enabled',        'value' => '1',                      'type' => 'boolean', 'is_public' => 0, 'label' => 'Blog Module',         'description' => 'Enable or disable the blog/news section.',               'sort_order' => 1],
            ['group' => 'features','key' => 'comments_enabled',    'value' => '1',                      'type' => 'boolean', 'is_public' => 0, 'label' => 'Comments',            'description' => 'Allow visitors to leave comments on posts.',             'sort_order' => 2],
            ['group' => 'features','key' => 'contact_form_enabled','value' => '1',                      'type' => 'boolean', 'is_public' => 0, 'label' => 'Contact Form',        'description' => 'Enable or disable the contact form.',                    'sort_order' => 3],
            ['group' => 'features','key' => 'search_enabled',      'value' => '1',                      'type' => 'boolean', 'is_public' => 0, 'label' => 'Site Search',         'description' => 'Enable the public site search functionality.',           'sort_order' => 4],
            ['group' => 'features','key' => 'maintenance_mode',    'value' => '0',                      'type' => 'boolean', 'is_public' => 0, 'label' => 'Maintenance Mode',    'description' => 'Show maintenance page to visitors.',                     'sort_order' => 5],
            ['group' => 'features','key' => 'registration_enabled','value' => '0',                      'type' => 'boolean', 'is_public' => 0, 'label' => 'Public Registration', 'description' => 'Allow visitors to register for accounts.',               'sort_order' => 6],
            // Security
            ['group' => 'security','key' => 'recaptcha_site_key',  'value' => '',                       'type' => 'string',  'is_public' => 0, 'label' => 'reCAPTCHA Site Key',  'description' => 'Google reCAPTCHA v3 site key.',                          'sort_order' => 1],
            ['group' => 'security','key' => 'recaptcha_secret_key','value' => '',                       'type' => 'encrypted','is_public' => 0, 'label' => 'reCAPTCHA Secret Key','description' => 'Google reCAPTCHA v3 secret key.',                         'sort_order' => 2],
            ['group' => 'security','key' => 'max_login_attempts',  'value' => '5',                      'type' => 'integer', 'is_public' => 0, 'label' => 'Max Login Attempts',  'description' => 'Login attempts before lockout (per minute).',            'sort_order' => 3],
        ];

        foreach ($configs as $config) {
            Configuration::updateOrCreate(['group' => $config['group'], 'key' => $config['key']], $config);
        }
    }
}
