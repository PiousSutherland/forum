<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return inertia('Posts/Index', [
            'posts' => PostResource::collection(Post::with('user')->latest()->latest('id')->paginate())
        ]);
    }

    public function show(Post $post)
    {
        $post->load('user');

        return inertia('Posts/Show', [
            'post' => fn () => PostResource::make($post),
            'comments' => fn () => CommentResource::collection($post->comments()->with('user')->latest()->latest('id')->paginate(10))
        ]);
    }
}
