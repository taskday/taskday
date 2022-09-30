<?php

namespace Taskday\Plugin\Support;

abstract class Action
{
    abstract public function getId(): string;
    abstract public function getLabel(): string;

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'label' => $this->getLabel()
        ];
    }
}
