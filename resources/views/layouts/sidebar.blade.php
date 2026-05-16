<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Sidebar header -->
        <div class="sidebar-section">
            <div class="sidebar-section-body d-flex justify-content-center">
                <h5 class="sidebar-resize-hide flex-grow-1 my-auto">Navigation</h5>

                <div>
                    <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                        <i class="ph-arrows-left-right"></i>
                    </button>

                    <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                        <i class="ph-x"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /sidebar header -->


        <!-- Main navigation -->
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                @php $activePackage = session('active_package', 'core/cms'); @endphp

                <!-- 1. CMS PACKAGE SIDEBAR -->
                @if($activePackage == 'core/cms')
                    <li class="nav-item-header">
                        <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Content Management</div>
                        <i class="ph-dots-three sidebar-resize-show"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="ph-image"></i>
                            <span>Media Manager</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="ph-newspaper"></i>
                            <span>CMS Posts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="ph-globe"></i>
                            <span>SEO Management</span>
                        </a>
                    </li>
                @endif

                <!-- 2. SETTINGS PACKAGE SIDEBAR -->
                @if($activePackage == 'core/settings')
                    <li class="nav-item-header">
                        <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">System Setup</div>
                        <i class="ph-dots-three sidebar-resize-show"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.settings.index') }}" class="nav-link">
                            <i class="ph-gear"></i>
                            <span>General Identity</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.theme.index') }}" class="nav-link">
                            <i class="ph-palette"></i>
                            <span>Theme Customizer</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.pagebuilder.index') }}" class="nav-link">
                            <i class="ph-layout"></i>
                            <span>Page Builder</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="ph-list"></i>
                            <span>Navigation Menus</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="ph-note-pencil"></i>
                            <span>Form Builder</span>
                        </a>
                    </li>
                @endif

                <!-- 3. AUTH PACKAGE SIDEBAR -->
                @if($activePackage == 'core/auth')
                    <li class="nav-item-header">
                        <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Security & Access</div>
                        <i class="ph-dots-three sidebar-resize-show"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="ph-users"></i>
                            <span>Users & Roles</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="ph-shield-check"></i>
                            <span>Audit Logs</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="ph-lock-key"></i>
                            <span>Security Settings</span>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->
    
</div>
<!-- /main sidebar -->
