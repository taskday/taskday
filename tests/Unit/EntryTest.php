<?php

use Taskday\Models\Entry;
use Taskday\Models\User;
use Taskday\Models\Field;

test('an entry has a title', function () {
    $entry = Entry::factory()->create(['title' => 'Fake Title']);
    $this->assertEquals('Fake Title', $entry->title);
});

test('an entry has an user id', function () {
    $user = User::factory()->create();
    $entry = Entry::factory()->create(['user_id' => $user->id]);
    $this->assertEquals($user->id, $entry->user_id);
});

test('cannot set field on entry if field does not exists', function () {
    $entry = Entry::factory()->create();

    $entry->setFieldValue(1, 'value');
})->expectException(\Taskday\Exceptions\UnkownFieldException::class);

test('can set field on entry if field exists', function () {
    $field = Field::factory()->create();
    $entry = Entry::factory()->create();

    $entry->setFieldValue($field, 'value');

    expect($entry->getRawFieldValue($field))->toBe('value');
});
