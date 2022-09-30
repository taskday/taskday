<?php

namespace Taskday\Plugin\Builtin\Progress;

use Taskday\Plugin\Support\GroupValue;

class ProgressValue extends GroupValue
{
    public function __construct(
        protected string $id,
        protected string $label,
        protected array $props,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getProps(): array
    {
        return $this->props;
    }
}
