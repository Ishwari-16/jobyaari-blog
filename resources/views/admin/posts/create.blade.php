@extends('layouts.app')

@section('title', 'Create Blog - Admin')

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
                    <h1 class="h2 fw-bold">Create Blog</h1>
                    <p class="text-muted mb-0">Add a new blog post</p>
                </div>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Back
                </a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label fw-bold">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" required placeholder="Enter blog title">
                                    @error('title')
                                        <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="short_description" class="form-label fw-bold">Short Description</label>
                                    <textarea class="form-control" id="short_description" name="short_description" rows="2" placeholder="Brief summary for the blog listing"></textarea>
                                    @error('short_description')
                                        <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label fw-bold">Content <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="content" name="content" rows="10" required placeholder="Write your blog content here..."></textarea>
                                    @error('content')
                                        <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label fw-bold">Category</label>
                                    <select class="form-select" id="category_id" name="category_id">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label fw-bold">Featured Image</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                    <small class="text-muted">Recommended size: 1200x630px</small>
                                    @error('image')
                                        <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="published_at" class="form-label fw-bold">Publish Date</label>
                                    <input type="date" class="form-control" id="published_at" name="published_at">
                                    @error('published_at')
                                        <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured">
                                    <label class="form-check-label fw-bold" for="is_featured">
                                        <i class="bi bi-star-fill text-warning me-1"></i>Featured Post
                                    </label>
                                    <small class="text-muted d-block">Featured posts appear prominently on the homepage</small>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-gradient">
                                <i class="bi bi-save me-2"></i>Create Blog
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
