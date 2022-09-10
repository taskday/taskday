<?php

namespace Taskday\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Taskday\Models\Concerns\HasFields;

class Entry extends Model
{
    use HasFactory;
    use HasFields;

    protected $guarded = [];

    public function fields(): BelongsToMany
    {
        return $this->belongsToMany(Field::class, 'fields_values')
            ->using(FieldValue::class)
            ->withPivot('value')
            ->withTimestamps();
    }
}
