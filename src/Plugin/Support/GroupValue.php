<?php

namespace Taskday\Plugin\Support;

use Illuminate\Contracts\Support\Arrayable;

class GroupValue implements Arrayable
{
    public function __construct(
        protected string|int $id,
        protected string|int $label,
        protected array $props,
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'label' => $this->label,
            'props' => $this->props,
        ];
    }
}
