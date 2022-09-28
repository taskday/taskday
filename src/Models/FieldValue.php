<?php

namespace Taskday\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Taskday\Models\Concerns\HasActivities;

class FieldValue extends Pivot
{
    protected $table = 'field_value';

    protected $casts = [
        'field_id' => 'integer',
        'entry_id' => 'integer',
    ];

    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }
}
