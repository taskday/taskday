<?php

namespace Taskday\Plugin\Builtin\Progress;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Taskday\Plugin\Builtin\Progress\Fields\LabelField;
use Taskday\Plugin\Builtin\Progress\Fields\ProgressField;
use Taskday\Plugin\Plugin;
use Taskday\Plugin\Support\Operator;
use Taskday\Plugin\Types\FilterType;

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

    public function filters(): Collection
    {
        return collect([
            new class extends FilterType {
                public string $type = 'board-filter';

                public function operators(): array
                {
                    return [
                        Operator::IS_EQUAL,
                        Operator::IS_NOT_EQUAL,
                    ];
                }

                public function apply(Builder $builder, array $filter)
                {
                    $operator = Operator::from($filter['operator']);

                    $handler = match ($operator) {
                        Operator::IS_EQUAL => function (Builder $query, string $value) {
                            $query->whereHas('board', function ($projects) use ($value) {
                                $projects->where('id', $value);
                            });
                        },
                        Operator::IS_NOT_EQUAL => function (Builder $query, string $value) {
                            $query->whereHas('board', function ($projects) use ($value) {
                                $projects->where('id', '<>', $value);
                            });
                        }
                    };

                    $handler($builder, $filter['value']);
                }
            }
        ]);
    }
}
