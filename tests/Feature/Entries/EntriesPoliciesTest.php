<?php

use Taskday\Models\Entry;
use Taskday\Models\User;
use Taskday\Models\Field;
use Inertia\Testing\AssertableInertia;
use Illuminate\Testing\Fluent\AssertableJson;

beforeEach(function () {
    $this->user = createUserAndlogin();
});

test('an entry cannot be viewed without permissions', function () {
    $entry = Entry::factory()->create();

    $this->get(route('entries.show', $entry))->assertForbidden();
    $this->get(route('api.entries.show', $entry))->assertForbidden();
});

test('an entry cannot be updated without permissions', function () {
    $entry = Entry::factory()->create();

    $this->put(route('entries.update', $entry))->assertForbidden();
    $this->put(route('api.entries.update', $entry))->assertForbidden();
});

test('an entry cannot be deleted without permissions', function () {
    $entry = Entry::factory()->create();

    $this->delete(route('entries.destroy', $entry))->assertForbidden();
    $this->delete(route('api.entries.destroy', $entry))->assertForbidden();
});
