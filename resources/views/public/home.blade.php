@extends('layouts.app')

@section('title', 'Welcome | Slack Website')

@section('page_title_main', 'Public Home')
@section('page_title_sub', 'Welcome to our website')

@section('content')
<div class="card">
    <div class="card-body text-center py-5">
        <h1 class="display-4 fw-bold mb-3">Welcome to Slack Website</h1>
        <p class="lead mb-4">This is the public-facing side of the platform.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="#" class="btn btn-primary btn-lg px-4">Our Services</a>
            <a href="#" class="btn btn-outline-primary btn-lg px-4">Contact Us</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card card-body">
            <div class="d-flex align-items-center">
                <i class="ph-lightbulb ph-2x text-primary me-3"></i>
                <div>
                    <h6 class="mb-0">Innovative Solutions</h6>
                    <span class="text-muted">We provide modern tools for your business.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-body">
            <div class="d-flex align-items-center">
                <i class="ph-shield-check ph-2x text-success me-3"></i>
                <div>
                    <h6 class="mb-0">Secure Platform</h6>
                    <span class="text-muted">Built with security as a priority.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-body">
            <div class="d-flex align-items-center">
                <i class="ph-rocket ph-2x text-info me-3"></i>
                <div>
                    <h6 class="mb-0">Fast Performance</h6>
                    <span class="text-muted">Optimized for a smooth experience.</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
