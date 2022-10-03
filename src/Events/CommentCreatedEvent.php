<?php

namespace Taskday\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Taskday\Models\Comment;

class CommentCreatedEvent implements ShouldQueue
{
    use Dispatchable;
    use SerializesModels;

    public Comment $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
}
