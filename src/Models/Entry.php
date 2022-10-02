<?php

namespace Taskday\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Laravel\Scout\Searchable;
use Taskday\Http\Resources\EntryResource;
use Taskday\Models\Concerns\Filterable;
use Taskday\Models\Concerns\HasFields;
use Taskday\Models\Concerns\HasActivities;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use Taskday\Models\Concerns\HasOwner;
use Taskday\Models\Filters\SearchFilter;

class Entry extends Model
{
    use HasFactory;
    use HasFields;
    use HasOwner;
    use HasActivities;
    use SoftDeletes;
    use Filterable;

    protected $guarded = [];

    protected $watch = [
        'title'
    ];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('withAccess', function (Builder $builder) {
            // $builder->where(function ($query) {
            //     $query->where('user_id', Auth::id());
            // })
            // ->orWhere(function ($query) {
            //     $query->whereHas('board', function ($query) {
            //         // @phpstan-ignore-next-line
            //         $query->whereIn('id', Auth::user()->sharedBoards->pluck('id'));
            //     });
            // });
        });
    }

    public function createComment(string $content): Comment
    {
        $comment = $this->comments()->create([
            'user_id' => Auth::id(),
            'content' => $content,
        ]);

        return $comment;
    }

    public function toSearchableArray(): array
    {
        return (array) EntryResource::make($this);
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
