<?php

namespace Taskday\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'options' => 'array'
    ];

    public function getFieldType()
    {
        return app($this->type);
    }

    public function values()
    {
        return $this->hasMany(FieldValue::class, 'field_id');
    }
}
