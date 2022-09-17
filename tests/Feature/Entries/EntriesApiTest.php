<?php

use Taskday\Models\User;
use Taskday\Models\Entry;
use Laravel\Sanctum\Sanctum;
use Taskday\Models\Field;
use Illuminate\Testing\Fluent\AssertableJson;

test('many entries can be fetched', function () {
    $entry = Entry::factory()->create();
    $field = Field::factory()->create();

    $entry->setFieldValue($field, 'foo');

    $this->actingAs(User::factory()->create())
        ->get(route('api.entries.index'))
        ->assertJson(fn (AssertableJson $page) => $page
            ->where('current_page', 1)
            ->where('per_page', 10)
            ->has('data', 1, fn (AssertableJson $page) => $page
                ->where('title', $entry->title)
                ->where('fields.0.field_id', $field->id)
                ->where('fields.0.value', 'foo')
                ->etc())
            ->etc());
});

test('an entry can be created with api', function () {
    $user = User::factory()->create();
    $entry = Entry::factory()->make();

    $this->withoutExceptionHandling();

    Sanctum::actingAs($user);

    $this->post(route('api.entries.store', [
            'title' => $entry->title,
        ]));

    expect(Entry::first()->title)->toBe($entry->title);
});

test('an entry can be fetched with all fields', function () {
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

test('an entry can be updated with api', function () {
    $entry = Entry::factory()->create();

    Sanctum::actingAs(User::factory()->create());

    $this->put(route('api.entries.update', $entry), [
        'title' => $entry->title,
    ])->assertStatus(204);
});

test('an entry can be deleted with api', function () {
    $entry = Entry::factory()->create();
    $field = Field::factory()->create();
    expect(Entry::count())->toBe(1);

    Sanctum::actingAs(User::factory()->create());

    $this->delete(route('api.entries.destroy', $entry))
        ->assertStatus(204);

    expect(Entry::count())->toBe(0);
});
