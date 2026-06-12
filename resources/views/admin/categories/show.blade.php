@extends('layouts.app')

@section('title', $category->name . ' - Admin')

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
                        <a class="sidebar-link" href="{{ route('admin.posts.index') }}">
                            <i class="bi bi-file-text me-2"></i> Blogs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="sidebar-link active" href="{{ route('admin.categories.index') }}">
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
                    <h1 class="h2 fw-bold">Category Details</h1>
                    <p class="text-muted mb-0">View category information</p>
                </div>
                <div class="btn-group">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-outline-warning">
                        <i class="bi bi-pencil me-2"></i>Edit
                    </a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this category? This will also delete all blogs in this category.')">
                            <i class="bi bi-trash me-2"></i>Delete
                        </button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h3 class="fw-bold mb-3">{{ $category->name }}</h3>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h6 class="fw-bold">Description</h6>
                                <p class="text-muted">{{ $category->description ?? 'No description provided.' }}</p>
                            </div>

                            <div class="mb-4">
                                <h6 class="fw-bold">Blogs in this Category</h6>
                                @if($category->blogs()->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Published</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($category->blogs()->latest()->take(5)->get() as $blog)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('admin.posts.show', $blog) }}" class="text-decoration-none">
                                                                {{ \Illuminate\Support\Str::limit($blog->title, 40) }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $blog->published_at ? $blog->published_at->format('M d, Y') : 'Draft' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if($category->blogs()->count() > 5)
                                        <small class="text-muted">Showing 5 of {{ $category->blogs()->count() }} blogs</small>
                                    @endif
                                @else
                                    <p class="text-muted">No blogs in this category yet.</p>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border-0 bg-light">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3">Category Information</h6>
                                    
                                    <div class="mb-3">
                                        <small class="text-muted">ID</small>
                                        <p class="fw-bold mb-0">#{{ $category->id }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <small class="text-muted">Slug</small>
                                        <p class="fw-bold mb-0 text-break">{{ $category->slug }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <small class="text-muted">Total Blogs</small>
                                        <p class="fw-bold mb-0">{{ $category->blogs()->count() }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <small class="text-muted">Created At</small>
                                        <p class="fw-bold mb-0">{{ $category->created_at->format('M d, Y H:i') }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <small class="text-muted">Updated At</small>
                                        <p class="fw-bold mb-0">{{ $category->updated_at->format('M d, Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Back to Categories
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
