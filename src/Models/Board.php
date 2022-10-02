<?php

namespace Taskday\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Laravel\Scout\Searchable;
use Taskday\Models\Concerns\HasMembers;
use Taskday\Models\Concerns\HasOwner;
use Taskday\Plugin\Contracts\Groupable;
use Illuminate\Support\Collection;

class Board extends Model
{
    use HasFactory;
    use HasOwner;
    use HasMembers;
    use SoftDeletes;
    use Searchable;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(config('taskday.user.model'));
    }

    public function fields(): HasMany
    {
        return $this->hasMany(Field::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function views(): HasMany
    {
        return $this->hasMany(View::class);
    }

    /** @return Collection<Field> */
    public function groups(): Collection
    {
        return $this->fields->where(fn ($field) => $field->getFieldType() instanceof Groupable);
    }

    public function entries(): HasMany
    {
        return $this->hasMany(Entry::class);
    }

    public function members(): BelongsToMany
    {
        return $this->morphToMany(config('taskday.user.model'), 'memberable', 'members')
            ->using(Member::class)
            ->withTimestamps();
    }

    /**
     * Get workspaces only visible to the current user.
     */
    public function scopeSharedWithCurrentUser($query)
    {
        return $query->whereIn('id', Auth::user()->sharedBoards->modelKeys());
    }
}
