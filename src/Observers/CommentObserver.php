<?php

namespace Taskday\Observers;

use Taskday\Models\Comment;
use Taskday\Events\CommentCreatedEvent;
use Taskday\Notifications\Notification;

class CommentObserver
{
    /**
     * Handle the Comment "created" event.
     *
     * @param  \Taskday\Models\Comment  $comment
     * @return void
     */
    public function created(Comment $comment)
    {
        $comment->entry->registerActivity('commented', [
            'comment_id' => $comment->id
        ]);

        CommentCreatedEvent::dispatch($comment);

        Notification::make()
            ->to($comment->entry->board->members)
            ->title("{$comment->owner->name} on {$comment->entry->board->title}")
            ->body("{$comment->owner->name} commented on entry {$comment->entry->title}")
            ->action("View comment", route('entries.show', $comment->entry))
            ->send();
    }

    /**
     * Handle the Comment "updated" event.
     *
     * @param  \Taskday\Models\Comment  $comment
     * @return void
     */
    public function updated(Comment $comment)
    {
        //
    }

    /**
     * Handle the Comment "deleted" event.
     *
     * @param  \Taskday\Models\Comment  $comment
     * @return void
     */
    public function deleted(Comment $comment)
    {
        //
    }

    /**
     * Handle the Comment "restored" event.
     *
     * @param  \Taskday\Models\Comment  $comment
     * @return void
     */
    public function restored(Comment $comment)
    {
        //
    }

    /**
     * Handle the Comment "force deleted" event.
     *
     * @param  \Taskday\Models\Comment  $comment
     * @return void
     */
    public function forceDeleted(Comment $comment)
    {
        //
    }
}
