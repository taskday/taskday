<?php
declare(strict_types = 1);

namespace Taskday\Models\Concerns;

use Taskday\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasOwner
{
    /**
     * Determine whether the user is the owner of the project.
     *
     * @param User $user
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
}
