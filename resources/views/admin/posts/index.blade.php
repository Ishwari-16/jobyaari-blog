@extends('layouts.app')

@section('title', 'Blogs - Admin')

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
                    <li class="nav-item mt-4">
                        <a class="sidebar-link" href="{{ route('home') }}" target="_blank">
                            <i class="bi bi-globe me-2"></i> View Site
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h2 fw-bold">Blogs</h1>
                    <p class="text-muted mb-0">Manage your blog posts</p>
                </div>
                <a href="{{ route('admin.posts.create') }}" class="btn btn-gradient">
                    <i class="bi bi-plus-circle me-2"></i>Add Blog
                </a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    @forelse($blogs as $blog)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Published</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blogs as $blog)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $blog->image_url }}" alt="" class="rounded me-2" style="width: 50px; height: 50px; object-fit: cover;">
                                                    <div>
                                                        <a href="{{ route('admin.posts.show', $blog) }}" class="text-decoration-none fw-bold">
                                                            {{ \Illuminate\Support\Str::limit($blog->title, 40) }}
                                                        </a>
                                                        <small class="text-muted d-block">{{ \Illuminate\Support\Str::limit($blog->short_description ?? $blog->content, 50) }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($blog->category)
                                                    <span class="badge badge-category">{{ $blog->category->name }}</span>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($blog->is_featured)
                                                    <span class="badge bg-warning text-dark">Featured</span>
                                                @else
                                                    <span class="badge bg-secondary">Standard</span>
                                                @endif
                                            </td>
                                            <td>{{ $blog->published_at ? $blog->published_at->format('M d, Y') : 'Draft' }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.posts.show', $blog) }}" class="btn btn-sm btn-outline-primary" title="View">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.posts.edit', $blog) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('admin.posts.destroy', $blog) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this blog?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="bi bi-journal-x empty-state-icon"></i>
                            <h4 class="fw-bold mb-3">No Blogs Yet</h4>
                            <p class="text-muted mb-4">Start by creating your first blog post to populate your blog.</p>
                            <a href="{{ route('admin.posts.create') }}" class="btn btn-gradient">
                                <i class="bi bi-plus-circle me-2"></i>Create Blog
                            </a>
                        </div>
                    @endforelse

                    <div class="mt-4">
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection