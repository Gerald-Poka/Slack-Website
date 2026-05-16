@extends('layouts.app')

@section('title', 'Theme Customizer')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Theme Customizer</h5>
            </div>

            <div class="card-body">
                <p class="mb-4 text-muted">Customize the look and feel of your website. These settings will dynamically update your public site's styles.</p>

                <form action="{{ route('admin.theme.update') }}" method="POST">
                    @csrf
                    @foreach($settings as $setting)
                        <div class="row mb-3 align-items-center">
                            <label class="col-lg-4 col-form-label fw-semibold">
                                {{ $setting->label }}
                                @if($setting->description)
                                    <div class="fs-xs text-muted fw-normal">{{ $setting->description }}</div>
                                @endif
                            </label>
                            <div class="col-lg-8">
                                @if($setting->type == 'color')
                                    <div class="d-flex align-items-center">
                                        <input type="color" name="{{ $setting->key }}" class="form-control form-control-color me-3" value="{{ $setting->value }}" title="Choose your color">
                                        <code>{{ $setting->value }}</code>
                                    </div>
                                @else
                                    <input type="text" name="{{ $setting->key }}" class="form-control" value="{{ $setting->value }}">
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <div class="text-end border-top pt-3 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="ph-palette me-2"></i>
                            Apply Theme Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card bg-light">
            <div class="card-header fw-bold">Theme Preview Tip</div>
            <div class="card-body">
                <p>When you click <strong>"Apply Theme Changes"</strong>, the system generates a dynamic CSS configuration that is applied to all public pages.</p>
                <div class="alert alert-info border-0 mb-0">
                    <i class="ph-info me-2"></i>
                    Using <strong>CSS Variables</strong> ensures that your site stays fast even with custom colors.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
