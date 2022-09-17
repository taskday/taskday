<?php

use Taskday\Models\Entry;
use Taskday\Models\Comment;
use Taskday\Models\User;

test('an entry can be commented', function () {
    $user = createUserAndlogin();
    $entry = Entry::factory()->create();

    $this->withoutExceptionHandling();

    $this->post(route('entries.comments.store', $entry), [
            'content' => Comment::factory()->make()->content
        ])
        ->assertSessionDoesntHaveErrors()
        ->assertRedirect();

    expect($entry->comments)->toHaveCount(1);
});
