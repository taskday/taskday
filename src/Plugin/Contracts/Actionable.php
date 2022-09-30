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
    public function actions(): Collection;
}
