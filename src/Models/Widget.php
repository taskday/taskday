<?php

namespace Taskday\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Taskday\Models\Concerns\HasOwner;

class Widget extends Model
{
    use HasFactory;
    use HasOwner;

    protected $guarded = [];
}
