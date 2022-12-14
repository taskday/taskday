<?php

namespace Taskday\Plugin\Contracts;

use Illuminate\Support\Collection;
use Taskday\Models\Field;

interface Groupable
{
    /**
     * Return an array of the possible values.
     *
     * @return Collection<GroupValue>
     */
    // @phpstan-ignore-next-line
    public function values(Field $field): Collection;
}
