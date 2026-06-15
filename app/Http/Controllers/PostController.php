<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $blogs = Post::with('category')->latest()->paginate(10);
        return view('admin.posts.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'short_description' => 'nullable',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'nullable|date',
            'is_featured' => 'nullable|boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public');
        }

        Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'content' => $request->content,
            'short_description' => $request->short_description,
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'published_at' => $request->published_at,
            'is_featured' => $request->is_featured ?? false,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Blog created successfully');
    }

    public function show(Post $blog)
    {
        return view('admin.posts.show', compact('blog'));
    }

    public function edit(Post $blog)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Post $blog)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'short_description' => 'nullable',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'nullable|date',
            'is_featured' => 'nullable|boolean',
        ]);

        $imagePath = $blog->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public');
        }

        $blog->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . $blog->id,
            'content' => $request->content,
            'short_description' => $request->short_description,
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'published_at' => $request->published_at,
            'is_featured' => $request->is_featured ?? false,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Blog updated successfully');
    }

    public function destroy(Post $blog)
    {
        $blog->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Blog deleted successfully');
    }
}
