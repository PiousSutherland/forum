<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return inertia('Posts/Index', [
            'post' => PostResource::make(Post::first()),
            'posts' => PostResource::collection(Post::latest()->latest('id')->paginate())
        ]);
    }

    public function show(Post $post)
    {
        return inertia('Posts/Show', ['post' => PostResource::make($post)]);
    }
}
