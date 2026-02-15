<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with(['author', 'category'])
            ->published()
            ->latest('published_at')
            ->paginate(9);

        $featured = BlogPost::with(['author', 'category'])
            ->published()
            ->latest('published_at')
            ->first();

        // If featured is in pagination, we might want to exclude it, but for simplicity let's keep it or handle it in view.
        // Actually, let's exclude the featured post from the main list if desired.
        // For now, simple pagination.

        return view('blog.index', compact('posts', 'featured'));
    }

    public function show($slug)
    {
        $post = BlogPost::with(['author', 'category'])
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        $recentPosts = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        $categories = BlogCategory::withCount('posts')->get();

        return view('blog.show', compact('post', 'recentPosts', 'categories'));
    }
}
