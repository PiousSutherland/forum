<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    function __construct()
    {
        $this->authorizeResource(Post::class);
    }

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

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required|string|min:10|max:120'],
            'body' => ['required|string|min:100|max:10000'],
        ]);

        $post = Post::create([
            ...$data,
            'user_id' => $request->user()->id,
        ]);

        return to_route('posts.show', $post);
    }

    public function create()
    {
        return inertia('Posts/Create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
