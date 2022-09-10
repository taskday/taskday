<?php

use Taskday\Models\User;
use Taskday\Models\Entry;
use Laravel\Sanctum\Sanctum;
use Taskday\Models\Field;
use Illuminate\Testing\Fluent\AssertableJson;

it('can create an entry through api', function () {
    $user = User::factory()->create();
    $entry = Entry::factory()->make();

    $this->withoutExceptionHandling();

    Sanctum::actingAs($user);

    $this->post(route('api.entries.store', [
            'title' => $entry->title,
        ]));

    expect(Entry::first()->title)->toBe($entry->title);
});

test('api can return all the fields', function () {
    $entry = Entry::factory()->create();
    $field = Field::factory()->create();

    $entry->setFieldValue($field, 'foo');

    Sanctum::actingAs(User::factory()->create());

    $res = $this->get(route('api.entries.show', $entry));

    $res->assertJson(fn (AssertableJson $json) =>
            $json->where('id', $entry->id)
                ->where('title', $entry->title)
                ->where('fields.0.value', 'foo')
                ->where('fields.0.field_id', $field->id)
                ->etc());
});
