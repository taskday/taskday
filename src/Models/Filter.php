<?php

namespace Taskday\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Taskday\Models\Concerns\HasOwner;

/**
 * @property string $type
 * @property string $column
 * @property string $operator
 * @property string $value
 */
class Filter extends Model
{
    use HasFactory;
    use HasOwner;

    protected $guarded = [];

    public function getFilterType()
    {
        return app($this->type);
    }
}
