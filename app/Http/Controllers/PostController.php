<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
 
    public function index(): View
    {
        $posts = Post::latest('published_at')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->paginate(10); // Last 10, paginated

        return view('resources', compact('posts'));
    }

    public function show(Post $post): View
    {
        if (!$post->published_at || $post->published_at > now()) {
            abort(404);
        }

        $related = Post::where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(4)
            ->get();

        return view('posts.show', compact('post', 'related'));
    }
}