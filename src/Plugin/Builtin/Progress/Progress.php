<?php

namespace Taskday\Plugin\Builtin\Progress;

use Taskday\Plugin\Plugin;
use Taskday\Plugin\Types\Field;
use Taskday\Plugin\Contracts\Groupable;
use Illuminate\Support\Collection;

class Progress extends Plugin
{
    public string $type = 'progress-plugin';

    public string $description = 'This built-in plugin add the progress field';

    public function fields(): array
    {
        return [
            new class extends Field implements Groupable {
                public string $type = 'progress';

                public function values(): Collection
                {
                    return collect([
                         new ProgressValue(0, 'Backlog', [ 'color' => 'gray' ]),
                         new ProgressValue(1, 'To Do', [ 'color' => 'red' ]),
                         new ProgressValue(2, 'In progress', [ 'color' => 'yellow' ]),
                         new ProgressValue(3, 'Done', [ 'color' => 'green' ]),
                    ]);
                }
            }
        ];
    }
}
