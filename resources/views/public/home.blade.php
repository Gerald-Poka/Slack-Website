@extends('layouts.public')

@section('content')
    @foreach($sections as $section)
        <div class="page-section {{ $section->css_class }}"
             id="{{ $section->css_id }}"
             style="padding-top: {{ $section->padding_top }}px; padding-bottom: {{ $section->padding_bottom }}px;">

            @foreach($section->blocks as $block)
{{--                @include('components.blocks.' . $block->type_name, ['block' => $block])--}}
            @endforeach

        </div>
    @endforeach
@endsection
