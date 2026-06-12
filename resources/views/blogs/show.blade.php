@extends('layouts.app')

@section('title', $blog->title . ' - JobYaari')

@section('content')
<!-- Hero Image -->
<div class="position-relative" style="height: 400px; overflow: hidden;">
    <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="w-100 h-100 object-fit-cover">
    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-end" style="background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);">
        <div class="container pb-4">
            @if(isset($blog->category) && $blog->category)
                <span class="badge badge-category mb-2">{{ $blog->category->name }}</span>
            @endif
            @if(isset($blog->is_featured) && $blog->is_featured)
                <span class="badge bg-warning text-dark mb-2 ms-2">
                    <i class="bi bi-star-fill me-1"></i>Featured
                </span>
            @endif
            <h1 class="text-white fw-bold display-5">{{ $blog->title }}</h1>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Blog Meta -->
            <div class="d-flex align-items-center text-muted mb-4">
                <span class="me-4">
                    <i class="bi bi-calendar3 me-2"></i>
                    @if(!empty($blog->published_at))
                        {{ \Carbon\Carbon::parse($blog->published_at)->format('M d, Y') }}
                    @else
                        {{ $blog->created_at ? $blog->created_at->format('M d, Y') : 'No Date' }}
                    @endif
                </span>
                <span>
                    <i class="bi bi-clock me-2"></i>
                    {{ \Illuminate\Support\Str::wordCount($blog->content) }} min read
                </span>
            </div>

            <!-- Blog Content -->
            <article class="blog-content mb-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        {!! $blog->content !!}
                    </div>
                </div>
            </article>

            <!-- Share Buttons -->
            <div class="card border-0 shadow-sm mb-5">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">Share this article</h6>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-twitter-x"></i> Twitter
                        </a>
                        <a href="#" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-linkedin"></i> LinkedIn
                        </a>
                        <a href="#" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-facebook"></i> Facebook
                        </a>
                        <button class="btn btn-outline-primary btn-sm" onclick="navigator.clipboard.writeText(window.location.href)">
                            <i class="bi bi-link"></i> Copy Link
                        </button>
                    </div>
                </div>
            </article>

            <!-- Related Posts -->
            @if(isset($blog->category) && $blog->category)
                @php
                    $relatedBlogs = $blog->category->blogs()->where('id', '!=', $blog->id)->latest()->take(3)->get();
                @endphp
                @if($relatedBlogs->count() > 0)
                    <div class="mt-5">
                        <h3 class="fw-bold mb-4"><i class="bi bi-collection me-2"></i>Related Articles</h3>
                        <div class="row g-4">
                            @foreach($relatedBlogs as $relatedBlog)
                                <div class="col-md-4">
                                    <div class="card card-hover h-100">
                                        <img src="{{ $relatedBlog->image_url }}" alt="{{ $relatedBlog->title }}" class="card-image w-100">
                                        <div class="card-body">
                                            <h6 class="card-title fw-bold mb-2">
                                                {{ \Illuminate\Support\Str::limit($relatedBlog->title, 50) }}
                                            </h6>
                                            <small class="text-muted">
                                                <i class="bi bi-calendar3 me-1"></i>
                                                {{ $relatedBlog->published_at ? $relatedBlog->published_at->format('M d') : 'Recent' }}
                                            </small>
                                            <a href="{{ route('blogs.show', $relatedBlog) }}" class="btn btn-gradient btn-sm mt-3 w-100">
                                                Read More
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Search -->
            <div class="sidebar mb-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-search me-2"></i>Search</h5>
                <form action="{{ route('blogs.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text"
                               name="query"
                               class="form-control"
                               placeholder="Search articles...">
                        <button class="btn btn-gradient" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Categories -->
            <div class="sidebar mb-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-folder me-2"></i>Categories</h5>
                @if($blog->category)
                    <div class="d-flex flex-column gap-2">
                        <a href="{{ route('blogs.index') }}" class="sidebar-link">
                            <i class="bi bi-grid me-2"></i>All Categories
                        </a>
                        <a href="#" class="sidebar-link active">
                            <i class="bi bi-folder2 me-2"></i>{{ $blog->category->name }}
                        </a>
                    </div>
                @else
                    <p class="text-muted small">Categories will appear here after creation.</p>
                @endif
            </div>

            <!-- Featured Posts -->
            <div class="sidebar">
                <h5 class="fw-bold mb-3"><i class="bi bi-star me-2"></i>Featured</h5>
                @php
                    $featuredBlogs = \App\Models\Blog::where('is_featured', true)->where('id', '!=', $blog->id)->latest()->take(3)->get();
                @endphp
                @if($featuredBlogs->count() > 0)
                    <div class="d-flex flex-column gap-3">
                        @foreach($featuredBlogs as $featured)
                            <a href="{{ route('blogs.show', $featured) }}" class="text-decoration-none">
                                <div class="card card-hover">
                                    <img src="{{ $featured->image_url }}" alt="{{ $featured->title }}" class="card-image w-100" style="height: 120px;">
                                    <div class="card-body p-3">
                                        <small class="text-muted">
                                            <i class="bi bi-calendar3 me-1"></i>
                                            {{ $featured->published_at ? $featured->published_at->format('M d') : 'Recent' }}
                                        </small>
                                        <h6 class="fw-bold mt-1 mb-0 text-dark">{{ \Illuminate\Support\Str::limit($featured->title, 40) }}</h6>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-star text-muted" style="font-size: 2rem;"></i>
                        <p class="text-muted mt-2 mb-0">No featured posts available.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
