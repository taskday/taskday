<?php

namespace Taskday\Notifications;

use Taskday\Facades\Taskday;

class PendingNotification
{
    public $title = '';

    public $body = '';

    public $actionUrl = null;

    public $actionLabel = null;

    public $users = [];

    public function title(string $title): static
    {
        $this->title = $title;

        return  $this;
    }

    public function body(string $body): static
    {
        $this->body = $body;

        return  $this;
    }

    public function action(string $label, string $url): static
    {
        $this->actionUrl = $url;
        $this->actionLabel = $label;

        return  $this;
    }

    public function to($users): static
    {
        $this->users = $users;

        return  $this;
    }

    public static function make()
    {
        return new static();
    }

    public function send()
    {
        Taskday::sendNotification($this);
    }
}
