<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->latest()->paginate(9);
        $categories = Category::all();

        return view('blogs.index', compact('blogs', 'categories'));
    }

    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $blogs = Blog::with('category')
            ->where('title', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->paginate(9);

        $categories = Category::all();

        return view('blogs.search', compact('blogs', 'query', 'categories'));
    }

    public function filter(Request $request)
    {
        $query = Blog::with('category');

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->date) {
            $query->whereDate('published_at', $request->date);
        }

        $blogs = $query->paginate(9);

        return response()->json([
            'html' => view('blogs.partials.blog-grid', compact('blogs'))->render(),
            'pagination' => $blogs->links()->toHtml()
        ]);
    }
}
