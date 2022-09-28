<?php

use Illuminate\Support\Facades\Event;
use Taskday\Models\User;
use Taskday\Models\Entry;
use Taskday\Models\Comment;
use Taskday\Events\CommentCreatedEvent;

beforeEach(function () {
    $this->user = createUserAndlogin();
});

test('an entry has comments activities', function () {
    Event::fake([ CommentCreatedEvent::class ]);
    $entry = Entry::factory()->create();
    $comment = $entry->createComment(Comment::factory()->make()->content);

    Event::assertDispatched(CommentCreatedEvent::class);

    expect($entry->comments)->toHaveCount(1);
    expect($entry->activities)->toHaveCount(2);
    expect($entry->activities[0]->event)->toBe('created');
    expect($entry->activities[0]->user_id)->toBe($this->user->id);
    expect($entry->activities[1]->event)->toBe('commented');
    expect($entry->activities[1]->user_id)->toBe($this->user->id);
    expect($entry->activities[1]->meta_data['comment_id'])->toBe($comment->id);
});

test('an entry has title activities', function () {
    $oldEntry = Entry::factory()->make();
    $newEntry = Entry::factory()->make();

    Entry::create($oldEntry->toArray())
        ->update(['title' => $newEntry->title ]);

    $entry = Entry::first();

    expect($entry->activities)->toHaveCount(2);

    expect($entry->activities[0]->event)->toBe('created');
    expect($entry->activities[0]->user_id)->toBe($this->user->id);
    expect($entry->activities[0]->old_values)->toBe([]);
    expect($entry->activities[0]->new_values)->toBe(['title' => $oldEntry->title ]);

    expect($entry->activities[1]->event)->toBe('updated');
    expect($entry->activities[1]->user_id)->toBe($this->user->id);
    expect($entry->activities[1]->old_values)->toBe(['title' => $oldEntry->title ]);
    expect($entry->activities[1]->new_values)->toBe(['title' => $newEntry->title ]);
});
