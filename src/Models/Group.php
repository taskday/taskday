<?php

namespace Taskday\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use NodeTrait;

    public function fields(): BelongsToMany
    {
        return $this->belongsToMany(Field::class);
    }
}
