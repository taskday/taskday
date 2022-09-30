<?php

namespace Taskday\Plugin\Builtin\Progress;

use Taskday\Models\Field;
use Taskday\Plugin\Plugin;
use Taskday\Plugin\Types\FieldType;
use Taskday\Plugin\Contracts\Groupable;
use Illuminate\Support\Collection;

class Progress extends Plugin
{
    public string $type = 'progress-plugin';

    public string $description = 'This built-in plugin add the progress field';

    public function fields(): Collection
    {
        return collect([
            new class extends FieldType implements Groupable {
                public string $type = 'progress';

                public function values(Field $field): Collection
                {
                    return collect([
                         new ProgressValue(0, 'Backlog', [ 'color' => 'gray' ]),
                         new ProgressValue(1, 'To Do', [ 'color' => 'red' ]),
                         new ProgressValue(2, 'In progress', [ 'color' => 'yellow' ]),
                         new ProgressValue(3, 'Done', [ 'color' => 'green' ]),
                    ]);
                }
            },
            new class extends FieldType implements Groupable {
                public string $type = 'label';

                public function boot()
                {
                    // TODO: update fields values if options changes
                }

                public function values(Field $field): Collection
                {
                    return collect($field->options)->map(function ($item, $index) {
                        return new ProgressValue($index, $item['label'], $item['props']);
                    });
                }
            }
        ]);
    }
}
