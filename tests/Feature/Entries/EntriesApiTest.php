<?php

use Taskday\Models\Board;
use Taskday\Models\User;
use Taskday\Models\Entry;
use Laravel\Sanctum\Sanctum;
use Taskday\Models\Field;
use Illuminate\Testing\Fluent\AssertableJson;

beforeEach(function () {
    $this->user = createUserAndlogin();
});

test('entries can be fetched', function () {
    $entry = Entry::factory()->create([
        'user_id' => $this->user,
    ]);
    $field = Field::factory()->create([
        'type' => 'progress'
    ]);

    $entry->setFieldValue($field, 'foo');

    $this->get(route('api.entries.index'))
        ->assertJson(fn (AssertableJson $page) => $page
            ->where('current_page', 1)
            ->where('per_page', 15)
            ->has('data', 1, fn (AssertableJson $page) => $page
                ->where('title', $entry->title)
                ->where('user_id', $this->user->id)
                ->where('fields.0.id', $field->id)
                ->where('fields.0.value', 'foo')
                ->etc())
            ->etc());
});

test('an entry can be created with api', function () {
    $entry = Entry::factory()->make();

    $this->post(route('api.entries.store'), [
        'title' => $entry->title,
        'board_id' => Board::factory()->create()->id
    ]);

    expect(Entry::first()->title)->toBe($entry->title);
});

test('an entry can be fetched with all fields', function () {
    $entry = Entry::factory()->owned()->create();
    $field = Field::factory()->create([
        'type' => 'progress',
    ]);

    $entry->setFieldValue($field, 'foo');

    $this->get(route('api.entries.show', $entry))
        ->assertOk()
        ->assertJson(fn (AssertableJson $json) => $json
            ->where('id', $entry->id)
                ->where('title', $entry->title)
                ->where('fields.0.value', 'foo')
                ->where('fields.0.id', $field->id)
                ->etc());
});

test('an entry can be updated with api', function () {
    $entry = Entry::factory()->owned()->create();
    $newTitle = Entry::factory()->make()->title;

    $this->put(route('api.entries.update', $entry), [
        'title' => $newTitle,
    ])->assertStatus(204);

    expect($entry->fresh()->title)->toBe($newTitle);
});

test('an entry can be deleted with api', function () {
    $entry = Entry::factory()->owned()->create();

    $this->delete(route('api.entries.destroy', $entry))
        ->assertStatus(204);

    expect(Entry::count())->toBe(0);
});
