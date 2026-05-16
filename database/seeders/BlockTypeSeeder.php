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
            [
                'name' => 'text',
                'label' => 'Text Block',
                'category' => 'content',
                'description' => 'A simple text content block.',
                'icon' => 'ph-text-aa',
                'schema' => json_encode(['fields' => ['content']]),
                'default_props' => json_encode([
                    'content' => 'This is a default text block content.'
                ]),
                'renderer_class' => 'App\Modules\PageBuilder\Renderers\TextRenderer',
                'is_active' => true,
            ],
            [
                'name' => 'image',
                'label' => 'Image Block',
                'category' => 'content',
                'description' => 'A block to display an image.',
                'icon' => 'ph-image',
                'schema' => json_encode(['fields' => ['image_url', 'alt_text']]),
                'default_props' => json_encode([
                    'image_url' => 'https://via.placeholder.com/600x400',
                    'alt_text' => 'Placeholder Image'
                ]),
                'renderer_class' => 'App\Modules\PageBuilder\Renderers\ImageRenderer',
                'is_active' => true,
            ],
            [
                'name' => 'video',
                'label' => 'Video Block',
                'category' => 'content',
                'description' => 'A block to display an embedded video.',
                'icon' => 'ph-video',
                'schema' => json_encode(['fields' => ['video_url', 'autoplay']]),
                'default_props' => json_encode([
                    'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', // Example YouTube embed URL
                    'autoplay' => false
                ]),
                'renderer_class' => 'App\Modules\PageBuilder\Renderers\VideoRenderer',
                'is_active' => true,
            ],
            [
                'name' => 'card-grid',
                'label' => 'Card Grid Block',
                'category' => 'layout',
                'description' => 'A grid of cards with title, description, and image.',
                'icon' => 'ph-grid-four',
                'schema' => json_encode(['fields' => ['cards']]),
                'default_props' => json_encode([
                    'cards' => [
                        [
                            'title' => 'Card 1 Title',
                            'description' => 'Description for card 1.',
                            'image_url' => 'https://via.placeholder.com/300x200'
                        ],
                        [
                            'title' => 'Card 2 Title',
                            'description' => 'Description for card 2.',
                            'image_url' => 'https://via.placeholder.com/300x200'
                        ],
                    ]
                ]),
                'renderer_class' => 'App\Modules\PageBuilder\Renderers\CardGridRenderer',
                'is_active' => true,
            ],
            [
                'name' => 'testimonial',
                'label' => 'Testimonial Block',
                'category' => 'content',
                'description' => 'A block to display customer testimonials.',
                'icon' => 'ph-chat-circle-dots',
                'schema' => json_encode(['fields' => ['quote', 'author', 'title']]),
                'default_props' => json_encode([
                    'quote' => 'This is a great product!',
                    'author' => 'John Doe',
                    'title' => 'CEO, Company'
                ]),
                'renderer_class' => 'App\Modules\PageBuilder\Renderers\TestimonialRenderer',
                'is_active' => true,
            ],
            [
                'name' => 'contact-form',
                'label' => 'Contact Form Block',
                'category' => 'form',
                'description' => 'A block with a contact form.',
                'icon' => 'ph-envelope-simple',
                'schema' => json_encode(['fields' => ['title', 'description', 'form_action_url']]),
                'default_props' => json_encode([
                    'title' => 'Contact Us',
                    'description' => 'Send us a message!',
                    'form_action_url' => '/contact'
                ]),
                'renderer_class' => 'App\Modules\PageBuilder\Renderers\ContactFormRenderer',
                'is_active' => true,
            ],
            [
                'name' => 'gallery',
                'label' => 'Image Gallery',
                'category' => 'content',
                'description' => 'A block to display a gallery of images.',
                'icon' => 'ph-images',
                'schema' => json_encode(['fields' => ['images']]),
                'default_props' => json_encode([
                    'images' => [
                        ['image_url' => 'https://via.placeholder.com/300x200', 'alt_text' => 'Gallery Image 1'],
                        ['image_url' => 'https://via.placeholder.com/300x200', 'alt_text' => 'Gallery Image 2'],
                    ]
                ]),
                'renderer_class' => 'App\Modules\PageBuilder\Renderers\GalleryRenderer',
                'is_active' => true,
            ],
            [
                'name' => 'accordion',
                'label' => 'Accordion Block',
                'category' => 'content',
                'description' => 'A block to display collapsible content sections.',
                'icon' => 'ph-rows',
                'schema' => json_encode(['fields' => ['items']]),
                'default_props' => json_encode([
                    'items' => [
                        ['title' => 'Accordion Item 1', 'content' => 'Content for accordion item 1.'],
                        ['title' => 'Accordion Item 2', 'content' => 'Content for accordion item 2.'],
                    ]
                ]),
                'renderer_class' => 'App\Modules\PageBuilder\Renderers\AccordionRenderer',
                'is_active' => true,
            ],
            [
                'name' => 'separator',
                'label' => 'Separator Block',
                'category' => 'layout',
                'description' => 'A simple horizontal line separator.',
                'icon' => 'ph-minus',
                'schema' => json_encode(['fields' => ['style']]),
                'default_props' => json_encode([
                    'style' => 'solid'
                ]),
                'renderer_class' => 'App\Modules\PageBuilder\Renderers\SeparatorRenderer',
                'is_active' => true,
            ],
            [
                'name' => 'staff-grid',
                'label' => 'Staff Grid Block',
                'category' => 'content',
                'description' => 'A grid displaying staff members with their photo, name, and title.',
                'icon' => 'ph-users',
                'schema' => json_encode(['fields' => ['staff_members']]),
                'default_props' => json_encode([
                    'staff_members' => [
                        [
                            'name' => 'Jane Doe',
                            'title' => 'CEO',
                            'photo_url' => 'https://via.placeholder.com/150'
                        ],
                        [
                            'name' => 'John Smith',
                            'title' => 'CTO',
                            'photo_url' => 'https://via.placeholder.com/150'
                        ],
                    ]
                ]),
                'renderer_class' => 'App\Modules\PageBuilder\Renderers\StaffGridRenderer',
                'is_active' => true,
            ],
            [
                'name' => 'map',
                'label' => 'Map Block',
                'category' => 'layout',
                'description' => 'An embedded map with a specified location.',
                'icon' => 'ph-map-pin',
                'schema' => json_encode(['fields' => ['latitude', 'longitude', 'zoom']]),
                'default_props' => json_encode([
                    'latitude' => 34.052235,
                    'longitude' => -118.243683,
                    'zoom' => 12
                ]),
                'renderer_class' => 'App\Modules\PageBuilder\Renderers\MapRenderer',
                'is_active' => true,
            ],
        ];

        foreach ($types as $type) {
            DB::table('block_types')->updateOrInsert(['name' => $type['name']], $type);
        }
    }
}
