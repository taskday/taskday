<?php

namespace Taskday\Models\Filters;

trait SearchFilterTrait
{
    public function search($query)
    {
        if (empty($query)) {
            return;
        }

        if (method_exists($this->builder->getModel(), 'toSearchableArray')) {
            $modelClass = get_class($this->builder->getModel());
            $this->builder->whereIn('id', $modelClass::search($query)->get()->pluck('id'));
        }
    }
}
