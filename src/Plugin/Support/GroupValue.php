<?php

namespace Taskday\Plugin\Support;

use Illuminate\Contracts\Support\Arrayable;

abstract class GroupValue implements Arrayable
{
    abstract public function getId(): string;
    abstract public function getLabel(): string;
    abstract public function getProps(): array;

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'label' => $this->getLabel(),
            'props' => $this->getProps(),
        ];
    }
}
