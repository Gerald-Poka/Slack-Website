@extends('layouts.app')

@section('title', 'Admin Dashboard | Slack Website')

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
        <h5 class="mb-0">Admin Overview</h5>
        <div class="ms-auto">
            <button type="button" class="btn btn-light btn-sm">
                <i class="ph-arrows-clockwise me-1"></i>
                Refresh
            </button>
        </div>
    </div>

    <div class="card-body">
        <h6>System Control Panel</h6>
        <p class="mb-3">Welcome to the Slack Website administration area. Here you can manage themes, pages, and system configurations as per the technical design document.</p>
        
        <div class="alert alert-info border-0 alert-dismissible fade show">
            <span class="fw-semibold">Admin Tip:</span> Role-based access control (RBAC) is active. Your actions are logged.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
</div>
@endsection
