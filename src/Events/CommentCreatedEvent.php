<?php

namespace Taskday\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Taskday\Http\Resources\CommentResource;
use Taskday\Models\Comment;

class CommentCreatedEvent implements ShouldBroadcast, ShouldQueue
{
    use Dispatchable;
    use InteractsWithSockets;
    use InteractsWithQueue;
    use SerializesModels;

    public function __construct(
        protected Comment $comment
    ) {
    }

    public function broadcastOn()
    {
        return new PrivateChannel('entries.' . $this->comment->entry->id . '.comments.' . $this->comment->id);
    }

    public function broadcastAs(): string
    {
        return 'comments.created';
    }

    public function broadcastWith(): array
    {
        return [
            'entry' => CommentResource::make($this->comment->fresh())
        ];
    }
}
