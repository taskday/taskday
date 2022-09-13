<?php

namespace Taskday\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Taskday\Models\Entry;
use Taskday\Http\Resources\EntryResource;

class EntryUpdatedEvent implements ShouldBroadcast, ShouldQueue
{
    use Dispatchable;
    use InteractsWithSockets;
    use InteractsWithQueue;
    use SerializesModels;

    protected Entry $entry;

    public function __construct(Entry $entry)
    {
        $this->entry = $entry;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('entries.' . $this->entry->id);
    }

    public function broadcastAs(): string
    {
        return 'entries.updated';
    }

    public function broadcastWith(): array
    {
        return [
            'entry' => EntryResource::make($this->entry->fresh())
        ];
    }
}
