<?php

namespace Taskday\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Taskday\Models\Entry;

class EntryUpdatedEvent implements ShouldQueue
{
    use Dispatchable;
    use SerializesModels;

    public Entry $entry;

    public function __construct(Entry $entry)
    {
        $this->entry = $entry;
    }
}
