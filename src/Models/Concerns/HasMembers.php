<?php

namespace Taskday\Models\Concerns;

use Taskday\Models\Member;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;

trait HasMembers
{
    /**
     * The name of the members model.
     *
     * @return string
     */
    public function memberableModel(): string
    {
        return Member::class;
    }

    /**
     * The members attached to the model.
     *
     * @return MorphMany
     */
    public function members(): MorphMany
    {
        return $this->morphMany($this->memberableModel(), 'memberable');
    }

    /**
     * Sync members.
     *
     * @param int[] $users
     */
    public function syncMembers(array $users)
    {
        $this->members()->whereNotIn('id', $users)->detach();

        $users = config('taskday.user.model')::find($users);

        $this->members()->saveMany($users);
    }

    /**
     * Sync members.
     * @param mixed $user
     * @return Member
     */
    public function addMember($user)
    {
        return $this->members()->save(config('taskday.user.model')::find($member));
    }

    /**
     * Delete a member.
     *
     * @param mixed $user
     */
    public function removeMember($user)
    {
        $id = is_numeric($user) ? $user : $user->id;

        $this->members()->where('id', $id)->first()->detach();
    }

    /**
     * Has member.
     *
     * @param mixed $user
     *
     * @return bool
     */
    public function hasMember($user): bool
    {
        $id = is_numeric($user) ? $user : $user->id;

        return $this->members()->where('id', $id)->count() > 0;
    }

    /**
     * The amount of members assigned to this model.
     *
     * @return mixed
     */
    public function membersCount(): int
    {
        return $this->members()->count();
    }
}
