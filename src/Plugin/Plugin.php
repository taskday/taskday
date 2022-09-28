<?php

namespace Taskday\Plugin;

use Taskday\Bundles\AssetBundle;

abstract class Plugin
{
    public string $type;

    public string $description;

    public function bundle(): ?AssetBundle
    {
        return null;
    }

    public function fields(): array
    {
        return [];
    }
}
