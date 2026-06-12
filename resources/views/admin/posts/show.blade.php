@extends('layouts.app')

@section('title', $blog->title . ' - Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 d-md-block sidebar collapse show">
            <div class="position-sticky pt-3">
                <div class="text-center mb-4">
                    <h5 class="fw-bold gradient-primary text-white rounded p-2">
                        <i class="bi bi-briefcase-fill me-2"></i>JobYaari
                    </h5>
                    <small class="text-muted">Admin Panel</small>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="sidebar-link active" href="{{ route('admin.posts.index') }}">
                            <i class="bi bi-file-text me-2"></i> Blogs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="sidebar-link" href="{{ route('admin.categories.index') }}">
                            <i class="bi bi-folder me-2"></i> Categories
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h2 fw-bold">Blog Details</h1>
                    <p class="text-muted mb-0">View blog post information</p>
                </div>
                <div class="btn-group">
                    <a href="{{ route('admin.posts.edit', $blog) }}" class="btn btn-outline-warning">
                        <i class="bi bi-pencil me-2"></i>Edit
                    </a>
                    <form action="{{ route('admin.posts.destroy', $blog) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this blog?')">
                            <i class="bi bi-trash me-2"></i>Delete
                        </button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="mb-4">
                        <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="img-fluid rounded" style="max-height: 400px;">
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="fw-bold mb-3">{{ $blog->title }}</h3>
                            
                            <div class="mb-4">
                                @if($blog->category)
                                    <span class="badge badge-category me-2">{{ $blog->category->name }}</span>
                                @endif
                                @if($blog->is_featured)
                                    <span class="badge bg-warning text-dark"><i class="bi bi-star-fill me-1"></i>Featured</span>
                                @endif
                            </div>

                            <div class="mb-4">
                                <h6 class="fw-bold">Short Description</h6>
                                <p class="text-muted">{{ $blog->short_description ?? 'N/A' }}</p>
                            </div>

                            <div class="mb-4">
                                <h6 class="fw-bold">Content</h6>
                                <div class="bg-light p-3 rounded">
                                    {!! $blog->content !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border-0 bg-light">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3">Blog Information</h6>
                                    
                                    <div class="mb-3">
                                        <small class="text-muted">ID</small>
                                        <p class="fw-bold mb-0">#{{ $blog->id }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <small class="text-muted">Slug</small>
                                        <p class="fw-bold mb-0 text-break">{{ $blog->slug }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <small class="text-muted">Published Date</small>
                                        <p class="fw-bold mb-0">{{ $blog->published_at ? $blog->published_at->format('M d, Y') : 'Not published' }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <small class="text-muted">Created At</small>
                                        <p class="fw-bold mb-0">{{ $blog->created_at->format('M d, Y H:i') }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <small class="text-muted">Updated At</small>
                                        <p class="fw-bold mb-0">{{ $blog->updated_at->format('M d, Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('blogs.show', $blog) }}" target="_blank" class="btn btn-gradient w-100 mt-3">
                                <i class="bi bi-eye me-2"></i>View on Site
                            </a>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Back to Blogs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
