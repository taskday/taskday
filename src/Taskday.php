<?php

namespace Taskday;

use Illuminate\Support\Collection;
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
        }

        $this->plugins[] = $plugin->type;
    }
}
