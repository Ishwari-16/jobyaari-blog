<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
    'title',
    'slug',
    'content',
    'short_description',
    'category_id',
    'image',
    'published_at',
    'is_featured',
    'user_id'
];

    protected $casts = [
    'published_at' => 'datetime',
    'is_featured' => 'boolean',
];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
