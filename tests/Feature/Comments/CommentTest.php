<?php

use Taskday\Models\Entry;
use Taskday\Models\Comment;
use Taskday\Models\User;

test('an entry can be commented', function () {
    $entry = Entry::factory()->create();
    $user = User::factory()->create();

    $this->withoutExceptionHandling();

    $this->actingAs($user)
        ->post(route('entries.comments.store', $entry), [
            'content' => Comment::factory()->make()->content
        ])
        ->assertSessionDoesntHaveErrors()
        ->assertRedirect();

    expect($entry->comments)->toHaveCount(1);
});
