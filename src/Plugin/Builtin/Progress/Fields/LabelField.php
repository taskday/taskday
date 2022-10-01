<?php

namespace Taskday\Plugin\Builtin\Progress\Fields;

use Illuminate\Support\Collection;
use Taskday\Models\Field;
use Taskday\Plugin\Builtin\Progress\ProgressValue;
use Taskday\Plugin\Contracts\Groupable;
use Taskday\Plugin\Support\GroupValue;
use Taskday\Plugin\Types\FieldType;

class LabelField extends FieldType implements Groupable
{
    public string $type = 'label';

    public function boot()
    {
        // TODO: update fields values if options changes
    }

    /**
     * @return Collection<GroupValue>
     */
    public function values(Field $field): Collection
    {
        return collect($field->options)->map(function ($item, $index) {
            return new GroupValue($index, $item['label'], $item['props']);
        });
    }
}
