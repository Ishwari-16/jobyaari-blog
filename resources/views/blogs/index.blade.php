@extends('layouts.app')

@section('title', 'Blog - JobYaari')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-3">Career Insights & Tips</h1>
                <p class="lead mb-4">Expert advice to help you advance your career and achieve your professional goals.</p>
                <div class="d-flex gap-3">
                    <a href="#blogs" class="btn btn-light btn-lg fw-semibold">Explore Blogs</a>
                    <a href="{{ route('blogs.search') }}" class="btn btn-outline-light btn-lg fw-semibold">Search</a>
                </div>
            </div>
            <div class="col-lg-4 d-none d-lg-block">
                <div class="text-center">
                    <i class="bi bi-book" style="font-size: 8rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<div class="container py-5" id="blogs">
    <div class="row">
        <!-- Blog Grid -->
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Latest Articles</h2>
                    <p class="text-muted mb-0">{{ $blogs->total() }} articles published</p>
                </div>
            </div>

            <!-- Blog Grid -->
            <div id="blog-grid" class="row g-4">
                @forelse($blogs as $index => $blog)
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
                            <i class="bi bi-journal-x empty-state-icon"></i>
                            <h4 class="fw-bold mb-3">No Blogs Found</h4>
                            <p class="text-muted mb-4">Check back later for new articles, or create your first blog post.</p>
                            <a href="{{ route('admin.posts.create') }}" class="btn btn-gradient">
                                <i class="bi bi-plus-circle me-2"></i>Create First Blog
                            </a>
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
                <h5 class="fw-bold mb-3"><i class="bi bi-search me-2"></i>Search</h5>
                <form action="{{ route('blogs.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text"
                               name="query"
                               class="form-control"
                               placeholder="Search articles..."
                               value="{{ request('query') }}">
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
                    <a href="{{ route('blogs.index') }}"
                       class="sidebar-link active">
                        <i class="bi bi-grid me-2"></i>All Categories
                        <span class="badge bg-primary float-end">{{ $blogs->total() }}</span>
                    </a>

                    @foreach($categories as $category)
                        <a href="#"
                           class="sidebar-link filter-category"
                           data-category-id="{{ $category->id }}">
                            <i class="bi bi-folder2 me-2"></i>{{ $category->name }}
                            <span class="badge bg-secondary float-end">{{ $category->blogs()->count() }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Date Filter -->
            <div class="sidebar mb-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-calendar-event me-2"></i>Filter by Date</h5>
                <input type="date" class="form-control" id="filter-date">
            </div>

            <!-- Featured Posts -->
            <div class="sidebar">
                <h5 class="fw-bold mb-3"><i class="bi bi-star me-2"></i>Featured</h5>
                @php
                    $featuredBlogs = \App\Models\Blog::where('is_featured', true)->latest()->take(3)->get();
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
                                            {{ $featured->published_at ? \Carbon\Carbon::parse($featured->published_at)->format('M d') : 'Recent' }}
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

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function () {
    function filterBlogs() {
        let categoryId = $('.filter-category.active').data('category-id');
        let date = $('#filter-date').val();

        $('#blog-grid').html('<div class="col-12 text-center py-5"><div class="loading-spinner"></div><p class="mt-3 text-muted">Loading...</p></div>');

        $.ajax({
            url: "{{ route('blogs.filter') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                category_id: categoryId,
                date: date
            },
            success: function(response) {
                if(response.html){
                    $('#blog-grid').html(response.html);
                }
                if(response.pagination){
                    $('.mt-5').html(response.pagination);
                }
            },
            error: function() {
                $('#blog-grid').html('<div class="col-12"><div class="alert alert-danger">Error loading blogs. Please try again.</div></div>');
            }
        });
    }

    $('.filter-category').on('click', function(e){
        e.preventDefault();
        $('.filter-category').removeClass('active');
        $(this).addClass('active');
        filterBlogs();
    });

    $('#filter-date').on('change', function(){
        filterBlogs();
    });
});
</script>
@endpush
