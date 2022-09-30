<?php

namespace Taskday\Plugin;

use Illuminate\Support\Collection;
use Taskday\Bundles\AssetBundle;

abstract class Plugin
{
    public string $type;

    public string $description;

    public function bundle(): ?AssetBundle
    {
        return null;
    }

    public function fields(): Collection
    {
        return collect([]);
    }

    public function views(): Collection
    {
        return collect([]);
    }
}
