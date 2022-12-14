<?php

namespace Taskday\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Taskday\Models\Entry;
use Taskday\Models\Comment;
use Taskday\Observers\EntryObserver;
use Taskday\Observers\CommentObserver;
use Taskday\Models\FieldValue;
use Taskday\Observers\FieldValueObserver;

class TaskdayEventServiceProvider extends EventServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Entry::observe(EntryObserver::class);
        Comment::observe(CommentObserver::class);
        FieldValue::observe(FieldValueObserver::class);
    }
}
