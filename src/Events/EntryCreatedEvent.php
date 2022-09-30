<?php

namespace Taskday\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Broadcasting\InteractsWithSockets;
use Taskday\Models\Entry;

class EntryCreatedEvent implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use SerializesModels;

    public function __construct(
        public Entry $entry
    ) {
    }
}
