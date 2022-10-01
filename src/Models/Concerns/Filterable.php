<?php

namespace Taskday\Models\Concerns;

use \Illuminate\Database\Eloquent\Builder;
use Laravel\Scout\Searchable;
use Taskday\Models\Filters\Filter;

trait Filterable
{
    use Searchable;

    /**
     * Scope a query to apply given filter.
     *
     * @param  Builder  $query
     * @param  Filter  $filter
     * @return Builder
     */
    public function scopeFilter(Builder $query, Filter $filter): Builder
    {
        return $filter->apply($query);
    }
}
