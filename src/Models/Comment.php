<?php

namespace Taskday\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;
use Taskday\Models\Concerns\HasOwner;

class Comment extends Model
{
    use HasFactory;
    use Searchable;
    use HasOwner;

    protected $guarded = [];

    protected $casts = [
        'id' => 'integer',
        'entry_id' => 'integer'
    ];

    public function entry(): BelongsTo
    {
        return $this->belongsTo(Entry::class);
    }
}
