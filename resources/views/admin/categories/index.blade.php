@extends('layouts.app')

@section('title', 'Categories - Admin')

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
                    <h1 class="h2 fw-bold">Categories</h1>
                    <p class="text-muted mb-0">Manage blog categories</p>
                </div>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-gradient">
                    <i class="bi bi-plus-circle me-2"></i>Add Category
                </a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    @forelse($categories as $category)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Blogs Count</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>
                                                <span class="fw-bold">{{ $category->name }}</span>
                                            </td>
                                            <td>
                                                <code class="text-muted">{{ $category->slug }}</code>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">{{ $category->blogs()->count() }}</span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-sm btn-outline-primary" title="View">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this category? This will also delete all blogs in this category.')">
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
                            <i class="bi bi-folder-x empty-state-icon"></i>
                            <h4 class="fw-bold mb-3">No Categories Found</h4>
                            <p class="text-muted mb-4">Categories will appear here after creation. Create your first category to organize your blog posts.</p>
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-gradient">
                                <i class="bi bi-plus-circle me-2"></i>Create Category
                            </a>
                        </div>
                    @endforelse

                    <div class="mt-4">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
