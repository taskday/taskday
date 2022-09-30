<?php

namespace Taskday\Plugin\Builtin\Table;

use Illuminate\Support\Collection;
use Taskday\Plugin\Plugin;

class Table extends Plugin
{
    public string $type = 'table-plugin';

    public string $description = 'Built-in plugin for table and kanban views.';

    public function views(): Collection
    {
        return collect([
            new TableView(),
            new KanbanView(),
        ]);
    }
}
