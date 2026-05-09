@extends('layouts.public')

@section('title', 'Welcome | Slack Website')

@section('content')
<div class="row align-items-center py-5">
    <div class="col-lg-6">
        <h1 class="display-3 fw-bold mb-4 text-slate-900">The most powerful modular CMS.</h1>
        <p class="lead fs-lg text-muted mb-5">
            Build, manage, and scale your website with a modular architecture that adapts to your needs. Professional, secure, and blazingly fast.
        </p>
        <div class="d-flex gap-3">
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-sm">Get Started</a>
            <a href="#" class="btn btn-outline-primary btn-lg px-5 py-3 rounded-pill">Learn More</a>
        </div>
    </div>
    <div class="col-lg-6 d-none d-lg-block">
        <div class="card border-0 shadow-lg overflow-hidden rounded-4">
            <img src="{{ asset('assets/images/demo/dashboard.png') }}" class="img-fluid" alt="Dashboard Preview" onerror="this.src='https://placehold.co/600x400?text=Dashboard+Preview'">
        </div>
    </div>
</div>

<div class="row g-4 mt-5">
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-4 text-center">
            <div class="bg-primary bg-opacity-10 rounded-circle w-64px h-64px d-flex align-items-center justify-content-center mx-auto mb-3">
                <i class="ph-squares-four ph-2x text-primary"></i>
            </div>
            <h5 class="fw-bold">Modular Architecture</h5>
            <p class="text-muted">Independent modules for CMS, Page Builder, Media, and more. Highly scalable and maintainable.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-4 text-center">
            <div class="bg-success bg-opacity-10 rounded-circle w-64px h-64px d-flex align-items-center justify-content-center mx-auto mb-3">
                <i class="ph-palette ph-2x text-success"></i>
            </div>
            <h5 class="fw-bold">Dynamic Theme Engine</h5>
            <p class="text-muted">Change your site's look and feel instantly with a powerful, configurable theme system.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-4 text-center">
            <div class="bg-info bg-opacity-10 rounded-circle w-64px h-64px d-flex align-items-center justify-content-center mx-auto mb-3">
                <i class="ph-shield-checkered ph-2x text-info"></i>
            </div>
            <h5 class="fw-bold">Enterprise Security</h5>
            <p class="text-muted">Role-based access control, activity auditing, and secure-by-default configurations.</p>
        </div>
    </div>
</div>
@endsection
