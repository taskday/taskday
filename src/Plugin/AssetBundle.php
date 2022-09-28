<?php

namespace Taskday\Bundles;

abstract class AssetBundle
{
    abstract public function scripts(): array;

    abstract public function styles(): array;
}
