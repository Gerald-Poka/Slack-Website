<!-- Page header -->
<div class="page-header page-header-light shadow">

    <div class="page-header-content d-lg-flex border-top">
        <div class="d-flex">
            <div class="breadcrumb py-2">
                <a href="{{ url('/') }}" class="breadcrumb-item"><i class="ph-house"></i></a>
                <a href="#" class="breadcrumb-item">Home</a>
                <span class="breadcrumb-item active">Dashboard</span>
            </div>

            <a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
            </a>
        </div>

        <div class="collapse d-lg-block ms-lg-auto" id="breadcrumb_elements">
            <div class="d-lg-flex mb-2 mb-lg-0">
                @php
                    $activePackage = session('active_package', 'core/cms');
                    $dbPackages = \App\Modules\Plugin\Models\Plugin::where('status', 'active')->get();
                    
                    // Find the active package details
                    $currentPackage = $dbPackages->where('name', $activePackage)->first() ?? $dbPackages->first();
                @endphp

                <div class="dropdown ms-lg-3">
                    <a href="#" class="d-flex align-items-center text-body dropdown-toggle py-2" data-bs-toggle="dropdown">
                        <i class="ph-squares-four me-2"></i>
                        <span class="flex-1 fw-bold text-uppercase fs-xs ls-1">Packages</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end w-100 w-lg-auto shadow-lg border-primary border-opacity-10">
                        <div class="dropdown-header text-uppercase fs-xs fw-bold border-bottom mb-2 pb-2">Available Packages</div>
                        
                        @foreach($dbPackages as $pkg)
                            @php $moduleSlug = str_replace('core/', '', $pkg->name); @endphp
                            
                            @if(auth()->user()->hasRole('super_admin') || auth()->user()->can('access module ' . $moduleSlug))
                                <form action="{{ route('admin.switch_package') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="package" value="{{ $pkg->name }}">
                                    <button type="submit" class="dropdown-item py-2 @if($activePackage == $pkg->name) active bg-primary bg-opacity-10 text-primary fw-semibold @endif">
                                        <i class="{{ $pkg->icon }} me-2 @if($activePackage == $pkg->name) text-primary @endif"></i>
                                        {{ $pkg->label }}
                                        @if($activePackage == $pkg->name)
                                            <i class="ph-check-circle ms-auto text-primary fs-sm"></i>
                                        @endif
                                    </button>
                                </form>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page header -->
