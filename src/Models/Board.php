<?php

namespace Taskday\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Taskday\Plugin\Contracts\Groupable;
use Illuminate\Support\Collection;

class Board extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function fields(): HasMany
    {
        return $this->hasMany(Field::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function views(): HasMany
    {
        return $this->hasMany(View::class);
    }

    /** @return Collection<Field> */
    public function groups(): Collection
    {
        return $this->fields->where(fn ($field) => $field->getFieldType() instanceof Groupable);
    }

    public function entries(): HasMany
    {
        return $this->hasMany(Entry::class);
    }
}
