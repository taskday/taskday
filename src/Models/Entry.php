<?php

namespace Taskday\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entry extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function fields(): BelongsToMany
    {
        return $this->belongsToMany(Field::class);
    }
}
