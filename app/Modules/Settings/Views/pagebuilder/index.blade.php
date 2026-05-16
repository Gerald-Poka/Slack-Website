@extends('layouts.app')

@section('title', 'Page Builder')

@section('content')
<div class="card">
    <div class="card-header d-flex align-items-center">
        <h5 class="mb-0">Your Website Pages</h5>
        <button class="btn btn-primary ms-auto">
            <i class="ph-plus me-2"></i>
            Create New Page
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>URL Path</th>
                    <th>Status</th>
                    <th>Last Modified</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pages as $page)
                <tr>
                    <td><span class="fw-semibold">{{ $page->title }}</span></td>
                    <td><code>{{ $page->slug == 'home' ? '/' : '/' . $page->slug }}</code></td>
                    <td><span class="badge bg-success bg-opacity-10 text-success">{{ $page->status }}</span></td>
                    <td>{{ \Carbon\Carbon::parse($page->updated_at)->diffForHumans() }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.pagebuilder.edit', $page->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="ph-pencil me-1"></i>
                            Build Page
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
