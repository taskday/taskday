<?php

use Taskday\Models\Entry;
use Taskday\Models\User;

test('an entry has a title', function () {
    $entry = Entry::factory()->create(['title' => 'Fake Title']);
    $this->assertEquals('Fake Title', $entry->title);
});

test('an entry has an user id', function () {
    $user = User::factory()->create();
    $entry = Entry::factory()->create(['user_id' => $user->id]);
    $this->assertEquals($user->id, $entry->user_id);
});
