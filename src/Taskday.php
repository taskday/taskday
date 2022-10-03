<?php

namespace Taskday;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Taskday\Notifications\Notification;
use Taskday\Notifications\PendingNotification;
use Taskday\Plugin\Plugin;

class Taskday
{
    protected Collection $plugins;

    public function __construct()
    {
        $this->plugins = new Collection();
    }

    public function register(Plugin $plugin): void
    {
        app()->singleton($plugin->type, fn () => $plugin);

        foreach ($plugin->fields() as $fieldType) {
            app()->singleton($fieldType->type, fn () => $fieldType);
            $fieldType->boot();
        }

        foreach ($plugin->widgets() as $widgetType) {
            app()->singleton($widgetType->type, fn () => $widgetType);
            $widgetType->boot();
        }

        $plugin->boot();

        $this->plugins[] = $plugin->type;
    }

    public function sendNotification(PendingNotification $pendingNotification)
    {
        foreach ($pendingNotification->users as $user) {
            if (Auth::id() != $user->id) {
                $user->notify(new Notification($pendingNotification));
            }
        }
    }
}
