<?php

use App\Http\Resources\PostResource;
use App\Models\Post;
use Inertia\Testing\AssertableInertia;

it('can show a post', function () {
    $post = Post::factory()->create();

    $this->get(route('posts.show', $post))
        ->assertComponent('Posts/Show');
});

it('passes a post to the view', function () {
    $post = Post::factory()->create();

    $this->get(route('posts.show', $post))
        ->assertHasResource('post', PostResource::make($post));
});
