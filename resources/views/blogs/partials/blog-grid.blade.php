@forelse($blogs as $blog)
    <div class="col-md-6">
        <div class="card card-hover h-100">
            <div class="position-relative overflow-hidden">
                @if($blog->image)
                    <img src="{{ $blog->image }}" alt="{{ $blog->title }}" class="card-image w-100">
                @else
                    <img src="https://images.pexels.com/photos/3184465/pexels-photo-3184465.jpeg" alt="{{ $blog->title }}" class="card-image w-100">
                @endif

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

                <h5 class="card-title fw-bold">
                    {{ \Illuminate\Support\Str::limit($blog->title, 60) }}
                </h5>

                <p class="card-text text-muted">
                    {{ \Illuminate\Support\Str::limit($blog->short_description ?? $blog->content, 100) }}
                </p>

                <div class="blog-meta mt-3 text-muted small">
                    <span>
                        <i class="bi bi-calendar3"></i>
                        @if(!empty($blog->published_at))
                            {{ \Carbon\Carbon::parse($blog->published_at)->format('M d, Y') }}
                        @else
                            {{ $blog->created_at ? $blog->created_at->format('M d, Y') : 'No Date' }}
                        @endif
                    </span>
                </div>

                <a href="{{ route('blogs.show', $blog) }}"
                   class="btn btn-gradient btn-sm mt-3">
                    Read More
                </a>
            </div>
        </div>
    </div>
@empty
    <div class="col-12">
        <div class="empty-state">
            <i class="bi bi-journal-x empty-state-icon"></i>
            <h4 class="fw-bold mb-3">No Blogs Found</h4>
            <p class="text-muted mb-4">No blogs match your criteria. Try different filters or browse all articles.</p>
            <a href="{{ route('blogs.index') }}" class="btn btn-gradient">
                <i class="bi bi-grid me-2"></i>Browse All Articles
            </a>
        </div>
    </div>
@endforelse
