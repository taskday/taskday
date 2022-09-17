<?php

namespace Taskday\Observers;

use Taskday\Models\Comment;
use Taskday\Events\CommentCreatedEvent;

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