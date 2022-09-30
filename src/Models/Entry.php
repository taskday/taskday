<?php

namespace Taskday\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use Taskday\Models\Concerns\HasFields;
use Taskday\Models\Concerns\HasActivities;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Entry extends Model
{
    use HasFactory;
    use HasFields;
    use HasActivities;
    use SoftDeletes;
    use Searchable;

    protected $guarded = [];

    protected $watch = [
        'title'
    ];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer'
    ];

    public function createComment(string $content): Comment
    {
        $comment = $this->comments()->create([
            'content' => $content
        ]);

        return $comment;
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class);
    }

    public function fields(): BelongsToMany
    {
        return $this->belongsToMany(Field::class, 'field_value')
            ->using(FieldValue::class)
            ->withPivot('value')
            ->withTimestamps();
    }
}
