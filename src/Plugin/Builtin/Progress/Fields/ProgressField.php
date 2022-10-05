<?php

namespace Taskday\Plugin\Builtin\Progress\Fields;

use Illuminate\Support\Collection;
use Taskday\Models\Field;
use Taskday\Plugin\Contracts\Groupable;
use Taskday\Plugin\Support\GroupValue;
use Taskday\Plugin\Types\FieldType;

class ProgressField extends FieldType implements Groupable
{
    public string $type = 'progress';

    // @phpstan-ignore-next-line
    public function values(Field $field): Collection
    {
        // @phpstan-ignore-next-line
        return new Collection([
             new GroupValue(0, 'Backlog', [ 'color' => 'gray' ]),
             new GroupValue(1, 'To Do', [ 'color' => 'red' ]),
             new GroupValue(2, 'In progress', [ 'color' => 'yellow' ]),
             new GroupValue(3, 'Done', [ 'color' => 'green' ]),
        ]);
    }
}
