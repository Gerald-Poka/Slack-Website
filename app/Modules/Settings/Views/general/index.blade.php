@extends('layouts.app')

@section('title', 'General Settings')

@section('content')
<div class="card">
    <div class="card-header d-flex align-items-center">
        <h5 class="mb-0">General Settings</h5>
    </div>

    <div class="card-body">
        <p class="mb-4">Configure your website's basic information and identity here. These changes will reflect across the entire site instantly.</p>

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            @foreach($settings as $setting)
                <div class="row mb-3">
                    <label class="col-lg-3 col-form-label fw-semibold">
                        {{ $setting->label }}
                        @if($setting->description)
                            <div class="fs-xs text-muted fw-normal">{{ $setting->description }}</div>
                        @endif
                    </label>
                    <div class="col-lg-9">
                        @if($setting->type == 'text')
                            <textarea name="{{ $setting->key }}" class="form-control" rows="3">{{ $setting->value }}</textarea>
                        @elseif($setting->type == 'boolean')
                            <div class="form-check form-switch">
                                <input type="checkbox" name="{{ $setting->key }}" class="form-check-input" @if($setting->value) checked @endif>
                            </div>
                        @else
                            <input type="{{ $setting->type == 'email' ? 'email' : 'text' }}" name="{{ $setting->key }}" class="form-control" value="{{ $setting->value }}">
                        @endif
                    </div>
                </div>
            @endforeach

            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="ph-floppy-disk me-2"></i>
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
