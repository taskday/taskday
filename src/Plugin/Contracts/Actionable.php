<?php

namespace Taskday\Plugin\Contracts;

use Illuminate\Support\Collection;

interface Actionable
{
    /**
     * Return an array of the possible values.
     *
     * @return Collection<string, Action>
     */
    // @phpstan-ignore-next-line
    public function actions(): Collection;
}
