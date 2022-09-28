<?php

namespace Taskday\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    use NodeTrait;

    protected $guarded = [];

    public function fields(): BelongsToMany
    {
        return $this->belongsToMany(Field::class);
    }

    public function boards(): HasMany
    {
        return $this->hasMany(Board::class);
    }
}
