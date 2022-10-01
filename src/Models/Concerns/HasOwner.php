<?php

declare(strict_types=1);

namespace Taskday\Models\Concerns;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasOwner
{
    /**
     * Determine whether the user is the owner of the project.
     *
     * @return bool
     */
    public function ownerIs($user)
    {
        return $this->user_id == $user->id;
    }

    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(config('taskday.user.model'), 'user_id');
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOwned($query)
    {
        return $query->where('user_id', Auth::id());
    }
}
