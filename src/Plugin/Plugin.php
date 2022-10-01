<?php

namespace Taskday\Plugin;

use Illuminate\Support\Collection;
use Taskday\Bundles\AssetBundle;
use Taskday\Plugin\Types\FieldType;
use Taskday\Plugin\Types\ViewType;
use Taskday\Plugin\Types\WidgetType;

abstract class Plugin
{
    public string $type;

    public string $description;

    public function bundle(): ?AssetBundle
    {
        return null;
    }

    /** @return Collection<\Taskday\Plugin\Types\FieldType>|iterable<\Taskday\Plugin\Types\FieldType> */
    public function fields()
    {
        return new Collection([]);
    }

    /** @return Collection<\Taskday\Plugin\Types\ViewType> */
    public function views(): Collection
    {
        return new Collection([]);
    }

    /** @return Collection<\Taskday\Plugin\Types\WidgetType> */
    public function widgets(): Collection
    {
        return new Collection([]);
    }
}
