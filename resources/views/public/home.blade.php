@extends('layouts.public')

@section('content')
    @foreach($sections as $section)
        <div class="page-section {{ $section->css_class }}"
             id="{{ $section->css_id }}"
            style="padding-top: {{ $section->padding_top }}px; padding-bottom: {{ $section->padding_bottom }}px;">

            @foreach($section->blocks as $block)
                @php
                    $blockViewMap = [
                        'HeroBlock' => 'hero',
                        'TextBlock' => 'text',
                        'ImageBlock' => 'image',
                        'VideoBlock' => 'video',
                        'CardGridBlock' => 'card-grid',
                        'TestimonialBlock' => 'testimonial',
                        'ContactFormBlock' => 'contact-form',
                        'AccordionBlock' => 'accordion',
                        'GalleryBlock' => 'gallery',
                        'CTABlock' => 'cta',
                        'SeparatorBlock' => 'separator',
                        'StaffGridBlock' => 'staff-grid',
                        'MapBlock' => 'map',
                        'CounterBlock' => 'counter',
                        'NewsGridBlock' => 'news-grid',
                        'features' => 'features',
                    ];

                    $blockView = $blockViewMap[$block->type_name] ?? $block->type_name;
                @endphp

                @include('components.blocks.' . $blockView, ['block' => $block])
            @endforeach

        </div>
    @endforeach
@endsection
