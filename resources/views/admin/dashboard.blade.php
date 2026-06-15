@extends('layouts.app')

@section('title', 'Admin Dashboard - JobYaari')

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
                        <a class="sidebar-link active" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="sidebar-link" href="{{ route('admin.posts.index') }}">
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
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="sidebar-link w-100 text-start border-0 bg-transparent">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4">
                <h1 class="h2 fw-bold">Dashboard</h1>
                <p class="text-muted mb-0">Welcome back, {{ auth()->user()->name }}!</p>
            </div>

            <!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-md-4 mb-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); color: white;">
                <i class="bi bi-file-text"></i>
            </div>
            <h6 class="text-muted mb-1">Total Blogs</h6>
            <h3 class="fw-bold mb-0">{{ \App\Models\Post::count() }}</h3>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #198754 0%, #20c997 100%); color: white;">
                <i class="bi bi-folder"></i>
            </div>
            <h6 class="text-muted mb-1">Categories</h6>
            <h3 class="fw-bold mb-0">{{ \App\Models\Category::count() }}</h3>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #6610F2 0%, #0D6EFD 100%); color: white;">
                <i class="bi bi-people"></i>
            </div>
            <h6 class="text-muted mb-1">Users</h6>
            <h3 class="fw-bold mb-0">{{ \App\Models\User::count() }}</h3>
        </div>
    </div>
</div>


            <!-- Recent Blogs -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="fw-bold mb-0"><i class="bi bi-clock-history me-2"></i>Recent Blogs</h5>
                                <a href="{{ route('admin.posts.index') }}" class="btn btn-gradient btn-sm">View All</a>
                            </div>
                        </div>
                        <div class="card-body">
                            @php
                                $recentBlogs = \App\Models\Blog::with('category')->latest()->take(5)->get();
                            @endphp
                            @if($recentBlogs->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Status</th>
                                                <th>Created</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentBlogs as $blog)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('admin.posts.show', $blog) }}" class="text-decoration-none fw-bold">
                                                            {{ \Illuminate\Support\Str::limit($blog->title, 40) }}
                                                        </a>
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
                                                    <td>{{ $blog->created_at->format('M d, Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="empty-state">
                                    <i class="bi bi-journal-x empty-state-icon"></i>
                                    <h4 class="fw-bold mb-3">No Blogs Yet</h4>
                                    <p class="text-muted mb-4">Start by creating your first blog post to populate your dashboard.</p>
                                    <a href="{{ route('admin.posts.create') }}" class="btn btn-gradient">
                                        <i class="bi bi-plus-circle me-2"></i>Create Blog
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3"><i class="bi bi-lightning me-2"></i>Quick Actions</h5>
                            <div class="d-grid gap-2">
                                <a href="{{ route('admin.posts.create') }}" class="btn btn-gradient">
                                    <i class="bi bi-plus-circle me-2"></i>Create New Blog
                                </a>
                                <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-primary">
                                    <i class="bi bi-folder-plus me-2"></i>Add Category
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3"><i class="bi bi-info-circle me-2"></i>System Info</h5>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">PHP Version</span>
                                <span class="fw-bold">{{ PHP_VERSION }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Laravel Version</span>
                                <span class="fw-bold">{{ app()->version() }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Environment</span>
                                <span class="badge {{ app()->environment('production') ? 'bg-danger' : 'bg-success' }}">
                                    {{ app()->environment() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
