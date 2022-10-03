<?php

namespace Taskday\Plugin\Builtin\Mentions;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Taskday\Events\CommentCreatedEvent;
use Taskday\Events\CommentUpdatedEvent;
use Taskday\Events\EntryCreatedEvent;
use Taskday\Events\EntryUpdatedEvent;
use Taskday\Notifications\Notification;
use Taskday\Plugin\Plugin;

class Mentions extends Plugin
{
    public string $type = 'mentions-plugin';

    public string $description = 'This built-in plugin add mentions';

    public function boot()
    {
        Event::listen(
            [
                EntryCreatedEvent::class,
                EntryUpdatedEvent::class,
                CommentCreatedEvent::class,
                CommentUpdatedEvent::class
            ],
            function ($event) {
                $owner = $event->comment?->owner ?? $event->entry->owner;
                $content = $event->comment?->content ?? $event->entry->content;
                $entry = $event->comment?->entry ?? $event->entry;
                $updated = $event->comment?->content ?? $event->entry->content;
                // todo: check if should send notificaiton or just an update

                $re = '/data-type="mention".*?data-id="(.*?)"/m';
                preg_match_all($re, $content, $matches, PREG_SET_ORDER, 0);

                $ids = collect($matches)
                    ->map(fn ($match) => $match[1])
                    ->filter(fn ($id) => Auth::id() != $id)
                    ->values();

                Notification::make()
                    ->to(config('taskday.user.model')::find($ids))
                    ->title("{$owner->name} on {$entry->board->title}")
                    ->body("{$owner->name} metioned you")
                    ->action("View entry", route('entries.show', $entry))
                    ->send();
            }
        );
    }

    public function fields(): Collection
    {
        return collect([

        ]);
    }
}
