<?php

namespace Taskday\Plugin\Builtin\Issue;

use Taskday\Plugin\Plugin;
use Illuminate\Support\Collection;

class Issue extends Plugin
{
    public string $type = 'issue-plugin';

    public string $description = 'This built-in plugin add progressive number on entries';

    public function fields(): Collection
    {
        return collect([
            new IssueField()
        ]);
    }
}
