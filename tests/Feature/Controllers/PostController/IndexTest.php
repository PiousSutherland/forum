<?php

use Inertia\Testing\AssertableInertia;

it('should return the correct component', function () {
    $this->get(route('posts.index'))
        ->assertInertia(
            fn (AssertableInertia $inertia) => $inertia
                ->component('Posts/Index', true)
        );
});

it('passes posts to the view', function () {
    $this->get(route('posts.index'))
        ->assertInertia(
            fn (AssertableInertia $inertia) => $inertia
                ->has('posts')
        );
});
