<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\PageBuilder\Models\BlockType;

class BlockTypeSeeder extends Seeder
{
    public function run(): void
    {
        $blockTypes = [
            [
                'name' => 'HeroBlock',
                'label' => 'Hero Banner',
                'category' => 'content',
                'icon' => 'hero',
                'description' => 'Full-width hero section with title, subtitle and CTA.',
                'schema' => [
                    'type' => 'object',
                    'properties' => [
                        'title' => ['type' => 'string'],
                        'subtitle' => ['type' => 'string'],
                        'bg_image_id' => ['type' => 'integer'],
                        'cta_text' => ['type' => 'string'],
                        'cta_url' => ['type' => 'string'],
                        'overlay_opacity' => ['type' => 'number', 'minimum' => 0, 'maximum' => 1],
                    ],
                ],
                'default_props' => [
                    'title' => 'Welcome to Our Website',
                    'subtitle' => 'We are glad you are here.',
                    'overlay_opacity' => 0.4,
                    'cta_text' => 'Get Started',
                    'cta_url' => '/contact',
                ],
                'renderer_class' => 'App\\Blocks\\HeroBlockRenderer',
                'sort_order' => 1,
            ],
            [
                'name' => 'TextBlock',
                'label' => 'Rich Text',
                'category' => 'content',
                'icon' => 'text',
                'description' => 'Rich text content block using CKEditor 5.',
                'schema' => [
                    'type' => 'object',
                    'properties' => [
                        'content' => ['type' => 'string'],
                        'alignment' => ['type' => 'string', 'enum' => ['left', 'center', 'right', 'justify']],
                    ],
                ],
                'default_props' => [
                    'content' => '<p>Enter your content here.</p>',
                    'alignment' => 'left',
                ],
                'renderer_class' => 'App\\Blocks\\TextBlockRenderer',
                'sort_order' => 2,
            ],
            [
                'name' => 'ImageBlock',
                'label' => 'Image',
                'category' => 'media',
                'icon' => 'image',
                'description' => 'Responsive image with optional caption.',
                'schema' => [
                    'type' => 'object',
                    'properties' => [
                        'media_id' => ['type' => 'integer'],
                        'alt_text' => ['type' => 'string'],
                        'caption' => ['type' => 'string'],
                        'alignment' => ['type' => 'string'],
                    ],
                ],
                'default_props' => [
                    'alignment' => 'center',
                ],
                'renderer_class' => 'App\\Blocks\\ImageBlockRenderer',
                'sort_order' => 3,
            ],
            [
                'name' => 'VideoBlock',
                'label' => 'Video Embed',
                'category' => 'media',
                'icon' => 'video',
                'description' => 'Embed YouTube, Vimeo, or self-hosted video.',
                'schema' => [
                    'type' => 'object',
                    'properties' => [
                        'video_url' => ['type' => 'string', 'format' => 'uri'],
                        'autoplay' => ['type' => 'boolean'],
                        'muted' => ['type' => 'boolean'],
                        'loop' => ['type' => 'boolean'],
                    ],
                ],
                'default_props' => [
                    'autoplay' => false,
                    'muted' => false,
                    'loop' => false,
                ],
                'renderer_class' => 'App\\Blocks\\VideoBlockRenderer',
                'sort_order' => 4,
            ],
            [
                'name' => 'CardGridBlock',
                'label' => 'Card Grid',
                'category' => 'content',
                'icon' => 'grid',
                'description' => 'Grid of feature or info cards.',
                'schema' => [
                    'type' => 'object',
                    'properties' => [
                        'cards' => ['type' => 'array'],
                        'columns' => ['type' => 'integer', 'minimum' => 1, 'maximum' => 4],
                        'style' => ['type' => 'string'],
                    ],
                ],
                'default_props' => [
                    'columns' => 3,
                    'style' => 'default',
                    'cards' => [],
                ],
                'renderer_class' => 'App\\Blocks\\CardGridBlockRenderer',
                'sort_order' => 5,
            ],
            [
                'name' => 'TestimonialBlock',
                'label' => 'Testimonials',
                'category' => 'content',
                'icon' => 'quote',
                'description' => 'Customer or staff testimonial cards.',
                'schema' => [
                    'type' => 'object',
                    'properties' => [
                        'testimonials' => ['type' => 'array'],
                        'layout' => ['type' => 'string', 'enum' => ['slider', 'grid']],
                    ],
                ],
                'default_props' => [
                    'layout' => 'grid',
                    'testimonials' => [],
                ],
                'renderer_class' => 'App\\Blocks\\TestimonialBlockRenderer',
                'sort_order' => 6,
            ],
            [
                'name' => 'ContactFormBlock',
                'label' => 'Contact Form',
                'category' => 'form',
                'icon' => 'form',
                'description' => 'Dynamic configurable contact form.',
                'schema' => [
                    'type' => 'object',
                    'properties' => [
                        'form_id' => ['type' => 'integer'],
                        'success_message' => ['type' => 'string'],
                    ],
                ],
                'default_props' => [
                    'success_message' => 'Thank you! We will be in touch soon.',
                ],
                'renderer_class' => 'App\\Blocks\\ContactFormBlockRenderer',
                'sort_order' => 7,
            ],
            [
                'name' => 'AccordionBlock',
                'label' => 'Accordion / FAQ',
                'category' => 'content',
                'icon' => 'accordion',
                'description' => 'Collapsible question and answer sections.',
                'schema' => [
                    'type' => 'object',
                    'properties' => [
                        'items' => ['type' => 'array'],
                        'allow_multiple' => ['type' => 'boolean'],
                    ],
                ],
                'default_props' => [
                    'allow_multiple' => false,
                    'items' => [],
                ],
                'renderer_class' => 'App\\Blocks\\AccordionBlockRenderer',
                'sort_order' => 8,
            ],
            [
                'name' => 'GalleryBlock',
                'label' => 'Photo Gallery',
                'category' => 'media',
                'icon' => 'gallery',
                'description' => 'Image grid or lightbox gallery.',
                'schema' => [
                    'type' => 'object',
                    'properties' => [
                        'media_ids' => ['type' => 'array'],
                        'columns' => ['type' => 'integer'],
                        'lightbox_enabled' => ['type' => 'boolean'],
                    ],
                ],
                'default_props' => [
                    'columns' => 3,
                    'lightbox_enabled' => true,
                    'media_ids' => [],
                ],
                'renderer_class' => 'App\\Blocks\\GalleryBlockRenderer',
                'sort_order' => 9,
            ],
            [
                'name' => 'CTABlock',
                'label' => 'Call to Action',
                'category' => 'content',
                'icon' => 'cta',
                'description' => 'Prominent call-to-action banner strip.',
                'schema' => [
                    'type' => 'object',
                    'properties' => [
                        'headline' => ['type' => 'string'],
                        'description' => ['type' => 'string'],
                        'button_text' => ['type' => 'string'],
                        'button_url' => ['type' => 'string'],
                        'bg_color' => ['type' => 'string'],
                    ],
                ],
                'default_props' => [
                    'headline' => 'Ready to get started?',
                    'button_text' => 'Contact Us',
                    'button_url' => '/contact',
                ],
                'renderer_class' => 'App\\Blocks\\CTABlockRenderer',
                'sort_order' => 10,
            ],
            [
                'name' => 'SeparatorBlock',
                'label' => 'Section Divider',
                'category' => 'layout',
                'icon' => 'separator',
                'description' => 'Visual divider between sections.',
                'schema' => [
                    'type' => 'object',
                    'properties' => [
                        'style' => ['type' => 'string', 'enum' => ['line', 'wave', 'dots', 'none']],
                        'spacing' => ['type' => 'string'],
                    ],
                ],
                'default_props' => [
                    'style' => 'line',
                    'spacing' => 'md',
                ],
                'renderer_class' => 'App\\Blocks\\SeparatorBlockRenderer',
                'sort_order' => 11,
            ],
            [
                'name' => 'StaffGridBlock',
                'label' => 'Staff Profiles',
                'category' => 'content',
                'icon' => 'people',
                'description' => 'Grid of team member cards with photo, name, and role.',
                'schema' => [
                    'type' => 'object',
                    'properties' => [
                        'staff' => ['type' => 'array'],
                        'columns' => ['type' => 'integer'],
                    ],
                ],
                'default_props' => [
                    'columns' => 3,
                    'staff' => [],
                ],
                'renderer_class' => 'App\\Blocks\\StaffGridBlockRenderer',
                'sort_order' => 12,
            ],
            [
                'name' => 'MapBlock',
                'label' => 'Map Embed',
                'category' => 'embed',
                'icon' => 'map',
                'description' => 'Embed Google Maps or OpenStreetMap location.',
                'schema' => [
                    'type' => 'object',
                    'properties' => [
                        'lat' => ['type' => 'number'],
                        'lng' => ['type' => 'number'],
                        'zoom' => ['type' => 'integer'],
                        'address_label' => ['type' => 'string'],
                    ],
                ],
                'default_props' => [
                    'zoom' => 15,
                ],
                'renderer_class' => 'App\\Blocks\\MapBlockRenderer',
                'sort_order' => 13,
            ],
            [
                'name' => 'CounterBlock',
                'label' => 'Stats Counter',
                'category' => 'content',
                'icon' => 'counter',
                'description' => 'Animated number statistics strip.',
                'schema' => [
                    'type' => 'object',
                    'properties' => [
                        'stats' => ['type' => 'array'],
                        'animate' => ['type' => 'boolean'],
                    ],
                ],
                'default_props' => [
                    'animate' => true,
                    'stats' => [],
                ],
                'renderer_class' => 'App\\Blocks\\CounterBlockRenderer',
                'sort_order' => 14,
            ],
            [
                'name' => 'NewsGridBlock',
                'label' => 'News / Blog Grid',
                'category' => 'content',
                'icon' => 'news',
                'description' => 'Dynamic grid pulling latest content posts.',
                'schema' => [
                    'type' => 'object',
                    'properties' => [
                        'category_id' => ['type' => 'integer'],
                        'limit' => ['type' => 'integer'],
                        'layout' => ['type' => 'string'],
                    ],
                ],
                'default_props' => [
                    'limit' => 6,
                    'layout' => 'grid',
                ],
                'renderer_class' => 'App\\Blocks\\NewsGridBlockRenderer',
                'sort_order' => 15,
            ],
        ];

        foreach ($blockTypes as $blockType) {
            BlockType::updateOrCreate(['name' => $blockType['name']], $blockType);
        }
    }
}
