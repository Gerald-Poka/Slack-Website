@extends('layouts.app')

@section('title', 'Dashboard | Slack Website')

@section('page_title_main', 'Dashboard')
@section('page_title_sub', 'Main Statistics')

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-1">
                        <h3 class="mb-0">12,500</h3>
                        <span class="text-uppercase fs-xs">Total Users</span>
                    </div>
                    <div class="ms-3">
                        <i class="ph-users ph-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-1">
                        <h3 class="mb-0">$45,200</h3>
                        <span class="text-uppercase fs-xs">Revenue</span>
                    </div>
                    <div class="ms-3">
                        <i class="ph-currency-circle-dollar ph-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-1">
                        <h3 class="mb-0">854</h3>
                        <span class="text-uppercase fs-xs">New Projects</span>
                    </div>
                    <div class="ms-3">
                        <i class="ph-briefcase ph-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex align-items-center">
        <h5 class="mb-0">Welcome to Slack Website</h5>
        <div class="ms-auto">
            <button type="button" class="btn btn-light btn-sm">
                <i class="ph-arrows-clockwise me-1"></i>
                Refresh
            </button>
        </div>
    </div>

    <div class="card-body">
        <h6>Project Overview</h6>
        <p class="mb-3">This project has been successfully initialized for the <strong>Slack Website</strong>. You can now start building your custom features using the robust layout and components provided.</p>
        
        <div class="alert alert-info border-0 alert-dismissible fade show">
            <span class="fw-semibold">Welcome!</span> All system components are ready for development.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
</div>
@endsection
