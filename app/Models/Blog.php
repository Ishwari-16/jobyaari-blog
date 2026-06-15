<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'content',
        'image',
        'category_id',
        'published_at',
        'meta_title',
        'meta_description',
        'is_featured',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getImageUrlAttribute()
    {
        // If image is a filename (not a URL), use public/images approach
        if ($this->image && !filter_var($this->image, FILTER_VALIDATE_URL)) {
            return Storage::url('images/' . $this->image);
        }

        // If image is already a full URL, return it directly
        if ($this->image && filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        // Category-based placeholder images
        $categoryName = $this->category ? strtolower($this->category->name) : 'general';

        $placeholders = [
            'career tips' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55d?w=800&q=80',
            'job search' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=800&q=80',
            'interview prep' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80',
            'resume building' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800&q=80',
            'workplace culture' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=800&q=80',
        ];

        return $placeholders[$categoryName] ?? 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800&q=80';
    }

}
