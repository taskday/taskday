<?php

namespace Taskday\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Taskday\Http\Resources\CategoryResource;
use Taskday\Models\Concerns\HasOwner;

class Category extends Model
{
    use HasFactory;
    use NodeTrait;
    use SoftDeletes;
    use HasOwner;

    protected $guarded = [];

    public function scopeGetResourced($query)
    {
        return $query->get()->map(fn ($entry) => CategoryResource::make($entry));
    }

    public function user(): BelongsTo
    {
        return $this->belongsToy(User::class);
    }

    public function fields(): BelongsToMany
    {
        return $this->belongsToMany(Field::class);
    }

    public function boards(): HasMany
    {
        return $this->hasMany(Board::class);
    }
}
