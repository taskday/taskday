<?php

namespace Taskday\Plugin\Builtin\Progress;

use Illuminate\Support\Collection;
use Taskday\Plugin\Builtin\Progress\Fields\LabelField;
use Taskday\Plugin\Builtin\Progress\Fields\ProgressField;
use Taskday\Plugin\Plugin;

class Progress extends Plugin
{
    public string $type = 'progress-plugin';

    public string $description = 'This built-in plugin add the progress field';

    public function fields(): Collection
    {
        return collect([
            new ProgressField(),
            new LabelField(),
        ]);
    }
}
