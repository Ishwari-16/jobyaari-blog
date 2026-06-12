@extends('layouts.app')

@section('title', 'Search Results - JobYaari')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="padding: 40px 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold mb-2">Search Results</h1>
                <p class="lead mb-0">Found {{ $blogs->total() }} results for "{{ $query }}"</p>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Blog Grid -->
            <div id="blog-grid" class="row g-4">
                @forelse($blogs as $blog)
                    <div class="col-md-6">
                        <div class="card card-hover h-100">
                            <div class="position-relative overflow-hidden">
                                <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="card-image w-100">

                                @if(isset($blog->is_featured) && $blog->is_featured)
                                    <span class="position-absolute top-0 start-0 m-3 badge badge-category">
                                        <i class="bi bi-star-fill me-1"></i>Featured
                                    </span>
                                @endif
                            </div>

                            <div class="card-body">
                                @if(isset($blog->category) && $blog->category)
                                    <span class="badge badge-category mb-3">
                                        {{ $blog->category->name }}
                                    </span>
                                @endif

                                <h5 class="card-title fw-bold mb-3">
                                    {{ \Illuminate\Support\Str::limit($blog->title, 60) }}
                                </h5>

                                <p class="card-text text-muted mb-3">
                                    {{ \Illuminate\Support\Str::limit($blog->short_description ?? $blog->content, 100) }}
                                </p>

                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        @if(!empty($blog->published_at))
                                            {{ \Carbon\Carbon::parse($blog->published_at)->format('M d, Y') }}
                                        @else
                                            {{ $blog->created_at ? $blog->created_at->format('M d, Y') : 'No Date' }}
                                        @endif
                                    </small>
                                    <a href="{{ route('blogs.show', $blog) }}"
                                       class="btn btn-gradient btn-sm">
                                        Read More <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="bi bi-search empty-state-icon"></i>
                            <h4 class="fw-bold mb-3">No Results Found</h4>
                            <p class="text-muted mb-4">We couldn't find any articles matching "{{ $query }}". Try different keywords or browse all articles.</p>
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('blogs.index') }}" class="btn btn-gradient">
                                    <i class="bi bi-grid me-2"></i>Browse All Articles
                                </a>
                                <a href="{{ route('blogs.index') }}" class="btn btn-outline-primary">
                                    <i class="bi bi-arrow-clockwise me-2"></i>Clear Search
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-5">
                {{ $blogs->links() }}
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Search -->
            <div class="sidebar mb-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-search me-2"></i>Search Again</h5>
                <form action="{{ route('blogs.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text"
                               name="query"
                               class="form-control"
                               placeholder="Search articles..."
                               value="{{ $query }}">
                        <button class="btn btn-gradient" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Categories -->
            <div class="sidebar mb-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-folder me-2"></i>Categories</h5>
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('blogs.index') }}" class="sidebar-link">
                        <i class="bi bi-grid me-2"></i>All Categories
                    </a>
                    @foreach($categories ?? [] as $category)
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-folder2 me-2"></i>{{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <a href="{{ route('blogs.index') }}" class="btn btn-outline-primary w-100">
                <i class="bi bi-arrow-left me-2"></i>Back to All Blogs
            </a>
        </div>
    </div>
</div>
@endsection
