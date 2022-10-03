<?php

use Taskday\Models\Board;
use Taskday\Models\Entry;
use Taskday\Models\User;
use Taskday\Models\Field;
use Inertia\Testing\AssertableInertia;
use Illuminate\Testing\Fluent\AssertableJson;

beforeEach(function () {
    $this->user = createUserAndlogin();
});

test('entries can be listed', function () {
    $entry = Entry::factory()->owned()->create();

    $this->get(route('entries.index'))
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Entries/Index')
                ->where('title', 'All Entries')
                ->where('entries.current_page', 1)
                ->where('entries.per_page', 15)
                ->has('entries.data', 1, fn (AssertableJson $page) => $page
                    ->where('title', $entry->title)
                    ->where('user_id', $this->user->id)
                    ->etc())
                ->etc());
});

test('an entry can be viewed', function () {
    $entry = Entry::factory()->owned()->create();
    $field = Field::factory()->create([
        'type' => 'progress'
    ]);

    $entry->setFieldValue($field, 'foo');

    $this->get(route('entries.show', $entry))
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Entries/Show')
                ->where('title', $entry->title)
                ->where('entry.title', $entry->title)
                ->where('entry.user_id', $this->user->id)
                ->where('entry.fields.0.id', $field->id)
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
            'board_id' => Board::factory()->create()->id
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
