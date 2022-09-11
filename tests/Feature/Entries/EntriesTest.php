<?php

use Taskday\Models\Entry;
use Taskday\Models\User;
use Taskday\Models\Field;
use Inertia\Testing\AssertableInertia;
use Illuminate\Testing\Fluent\AssertableJson;

test('entries can be listed', function () {
    $entry = Entry::factory()->create();
    $field = Field::factory()->create();

    $entry->setFieldValue($field, 'foo');

    $this->actingAs(User::factory()->create())
        ->get(route('entries.index'))
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Entries/Index')
                ->where('title', 'All Entries')
                ->where('entries.current_page', 1)
                ->where('entries.per_page', 10)
                ->has('entries.data', 1, fn (AssertableJson $page) => $page
                    ->where('title', $entry->title)
                    ->where('fields.0.field_id', $field->id)
                    ->where('fields.0.value', 'foo')
                    ->etc()
                )
                ->etc()
            );
});

test('entries can be stored with a title', function () {
    $user = User::factory()->create();
    $entry = Entry::factory()->make();

    $this->withoutExceptionHandling();

    $this->actingAs($user)
        ->post(route('entries.store', [
            'title' => $entry->title,
        ]));

    expect(Entry::first()->title)->toBe($entry->title);
});

test('entries can be update', function () {
    $user = User::factory()->create();
    $entry = Entry::factory()->make();

    $this->withoutExceptionHandling();

    $this->actingAs($user)
        ->post(route('entries.store', [
            'title' => $entry->title,
        ]))
        ->assertRedirect();

    expect(Entry::first()->title)->toBe($entry->title);
});

it('can delete an entry', function () {
    $entry = Entry::factory()->create();
    $field = Field::factory()->create();
    expect(Entry::count())->toBe(1);

    $this
        ->actingAs(User::factory()->create())
        ->delete(route('entries.destroy', $entry))
        ->assertRedirect();

    expect(Entry::count())->toBe(0);
});
