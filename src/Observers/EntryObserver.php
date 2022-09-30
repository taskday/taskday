<?php

namespace Taskday\Observers;

use Taskday\Models\Entry;
use Taskday\Events\EntryUpdatedEvent;
use Taskday\Models\Activity;
use Illuminate\Support\Arr;
use Taskday\Events\EntryCreatedEvent;

class EntryObserver
{
    /**
     * Handle the Entry "created" event.
     *
     * @param  \Taskday\Models\Entry  $entry
     * @return void
     */
    public function created(Entry $entry)
    {
        $entry->registerActivity('created');

        event(new EntryCreatedEvent($entry));
    }

    /**
     * Handle the Entry "updated" event.
     *
     * @param  \Taskday\Models\Entry  $entry
     * @return void
     */
    public function updated(Entry $entry)
    {
        $entry->registerActivity('updated');
    }

    /**
     * Handle the Entry "deleted" event.
     *
     * @param  \Taskday\Models\Entry  $entry
     * @return void
     */
    public function deleted(Entry $entry)
    {
        //
    }

    /**
     * Handle the Entry "restored" event.
     *
     * @param  \Taskday\Models\Entry  $entry
     * @return void
     */
    public function restored(Entry $entry)
    {
        //
    }

    /**
     * Handle the Entry "force deleted" event.
     *
     * @param  \Taskday\Models\Entry  $entry
     * @return void
     */
    public function forceDeleted(Entry $entry)
    {
        //
    }
}
