<?php

use Taskday\Models\Entry;
use Taskday\Models\Comment;
use Taskday\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

test('many comments can be fetched', function () {
    $entry = Entry::factory()->create();
    $user = User::factory()->create();

    Comment::factory()->times(10)->create([
        'entry_id' => $entry->id,
    ]);

    $this->actingAs($user)
        ->get(route('api.entries.comments.index', [$entry]))
        ->assertSessionDoesntHaveErrors()
        ->assertJson(fn (AssertableJson $json) => $json
            ->has(10)
            ->etc());
});

test('a comment can be fetched', function () {
    $entry = Entry::factory()->create();
    $user = User::factory()->create();

    $comment = Comment::factory()->create([
        'entry_id' => $entry->id,
    ]);

    $this->actingAs($user)
        ->get(route('api.entries.comments.show', [$entry, $comment]))
        ->assertSessionDoesntHaveErrors()
        ->assertJson(fn (AssertableJson $json) => $json
            ->where('id', $comment->id)
            ->where('content', $comment->content)
            ->etc());
});
