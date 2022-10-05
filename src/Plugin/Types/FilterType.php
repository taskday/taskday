<?php

namespace Taskday\Plugin\Types;

use Illuminate\Contracts\Support\Arrayable;

abstract class FilterType implements Arrayable
{
    public string $type;

    public function boot()
    {
        //
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'operators' => $this->operators(),
        ];
    }
}
