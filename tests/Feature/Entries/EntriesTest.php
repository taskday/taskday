<?php

use Taskday\Models\Entry;
use Taskday\Models\User;

test('entries can be created with a title', function () {
    $user = User::factory()->create();
    $entry = Entry::factory()->make();

    $this->withoutExceptionHandling();

    $this->actingAs($user)
        ->post(route('entries.store', [
            'title' => $entry->title,
        ]));

    expect(Entry::first()->title)->toBe($entry->title);
});
