<?php

use Taskday\Models\Entry;
use Taskday\Models\User;
use Taskday\Models\Field;
use Inertia\Testing\AssertableInertia;
use Illuminate\Testing\Fluent\AssertableJson;

beforeEach(function () {
    $this->user = createUserAndlogin();
});

test('entries can be listed', function () {
    $entry = $this->user->createEntry(Entry::factory()->make()->title);

    Entry::factory()->times(2)->create();
    $field = Field::factory()->create();

    $entry->setFieldValue($field, 'foo');

    $this->get(route('entries.index'))
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Entries/Index')
                ->where('title', 'All Entries')
                ->where('entries.current_page', 1)
                ->where('entries.per_page', 10)
                ->has('entries.data', 1, fn (AssertableJson $page) => $page
                    ->where('title', $entry->title)
                    ->where('user_id', $this->user->id)
                    ->where('fields.0.field_id', $field->id)
                    ->where('fields.0.value', 'foo')
                    ->etc())
                ->etc());
});

test('an entry can be viewed', function () {
    $entry = Entry::factory()->owned()->create();
    $field = Field::factory()->create();

    $entry->setFieldValue($field, 'foo');

    $this->get(route('entries.show', $entry))
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Entries/Show')
                ->where('title', $entry->title)
                ->where('entry.title', $entry->title)
                ->where('entry.user_id', $this->user->id)
                ->where('entry.fields.0.field_id', $field->id)
                ->where('entry.fields.0.value', 'foo')
                ->etc());
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
    expect(Entry::first()->user_id)->toBe($user->id);
});

test('entries can be update', function () {
    $entry = Entry::factory()->owned()->create();
    $data = Entry::factory()->make();

    $this->withoutExceptionHandling();

    $this->put(route('entries.update', $entry), [
            'title' => $data->title,
        ])
        ->assertRedirect();

    $entry = $entry->fresh();
    expect($entry->title)->toBe($data->title);
    expect($entry->activities()->count())->toBe(2);
});

it('can delete an entry', function () {
    $entry = Entry::factory()->owned()->create();
    $field = Field::factory()->create();
    expect(Entry::count())->toBe(1);

    $this->delete(route('entries.destroy', $entry))
        ->assertRedirect();

    expect(Entry::count())->toBe(0);
});
