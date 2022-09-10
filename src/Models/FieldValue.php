<?php

namespace Taskday\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FieldValue extends Pivot
{
    protected $table = 'fields_values';

    protected $casts = [
        'field_id' => 'integer',
        'entry_id' => 'integer',
    ];
}