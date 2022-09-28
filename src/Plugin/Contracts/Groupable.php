<?php

namespace Taskday\Plugin\Contracts;

use Illuminate\Support\Collection;

interface Groupable
{
    /**
     * Return an array of the possible values.
     *
     * @return Collection<GroupValue>
     */
    public function values(): Collection;
}
