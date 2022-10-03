<?php

namespace Taskday\Observers;

use Taskday\Models\Entry;
use Taskday\Events\EntryUpdatedEvent;
use Taskday\Models\Activity;
use Illuminate\Support\Arr;
use Taskday\Events\EntryCreatedEvent;
use Taskday\Notifications\Notification;

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

        EntryCreatedEvent::dispatch($entry);
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

        EntryUpdatedEvent::dispatch($entry);
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
