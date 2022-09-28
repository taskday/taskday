<?php

namespace Taskday\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BoardField extends Pivot
{
    protected $table = 'board_field';

    protected $casts = [
        'board_id' => 'integer',
        'field_id' => 'integer',
    ];
}
