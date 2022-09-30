<?php

namespace Taskday\Plugin\Builtin\Issue;

use Taskday\Plugin\Support\Action;
use Taskday\Models\Field;
use Taskday\Models\Entry;
use Illuminate\Http\Request;

class GenerateAction extends Action
{
    public function getId(): string
    {
        return 'generate';
    }

    public function getLabel(): string
    {
        return 'Generate';
    }

    public function handle(Entry $entry, Field $field)
    {
        $entry->setFieldValue($field, $field->getFieldType()->nextValueFor($field, $entry->board));
    }
}
