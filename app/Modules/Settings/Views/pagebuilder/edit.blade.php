@extends('layouts.app')

@section('title', 'Editing: ' . $page->title)

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="mb-3 d-flex align-items-center">
            <h4 class="mb-0">Page Editor: <span class="fw-normal">{{ $page->title }}</span></h4>
            <div class="ms-auto">
                <a href="{{ url($page->slug) }}" target="_blank" class="btn btn-light me-2">
                    <i class="ph-eye me-1"></i>
                    Preview
                </a>
                <button class="btn btn-primary">
                    <i class="ph-check me-1"></i>
                    Publish Changes
                </button>
            </div>
        </div>

        <div id="page-sections">
            @forelse($sections as $section)
                <div class="card mb-3 border-start border-start-width-5 border-start-primary shadow-sm">
                    <div class="card-header d-flex align-items-center py-2">
                        <i class="ph-dots-six-vertical me-2 opacity-50 cursor-move"></i>
                        <h6 class="mb-0">{{ $section->name }}</h6>
                        <div class="ms-auto">
                            <button class="btn btn-sm btn-icon btn-light rounded-pill border-transparent">
                                <i class="ph-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-icon btn-light rounded-pill border-transparent text-danger ms-1">
                                <i class="ph-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info text-center p-5">
                    <i class="ph-layout ph-3x mb-3 opacity-50"></i>
                    <h5>No sections yet</h5>
                    <p>Start building your page by adding a block from the right panel.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm sticky-lg-top" style="top: 20px;">
            <div class="card-header bg-dark text-white">
                <h6 class="mb-0">Available Blocks</h6>
            </div>
            <div class="list-group list-group-flush">
                @foreach($blockTypes as $type)
                    <form action="{{ route('admin.pagebuilder.add_section', $page->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="block_type_id" value="{{ $type->id }}">
                        <button type="submit" class="list-group-item list-group-item-action d-flex align-items-center p-3">
                            <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-pill me-3">
                                <i class="{{ $type->icon }} fs-lg"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-bold">{{ $type->label }}</div>
                                <div class="fs-xs text-muted">{{ $type->description }}</div>
                            </div>
                            <i class="ph-plus-circle opacity-50"></i>
                        </button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
