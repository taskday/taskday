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
     *
     * @return Member[]
     */
    public function syncMembers(array $users)
    {
        $members = collect($users)->unique()->map(fn ($user) => Member::updateOrCreate([ 'user_id' => $user, 'memberable_type' => $this->getMorphClass(), 'memberable_id' => $this->getKey() ]));

        $this->members()->whereNotIn('user_id', $users)->delete();

        return $this->members()->saveMany($members);
    }

    /**
     * Sync members.
     *
     * @param int $id
     *
     * @return Member
     */
    public function addMember($user)
    {
        $id = is_numeric($user) ? $user : $user->id;

        $this->parent()?->addMember($user);

        $member = Member::updateOrCreate([ 'user_id' => $id, 'memberable_type' => $this->getMorphClass(), 'memberable_id' => $this->getKey() ]);

        return $this->members()->save($member);
    }

    /**
     * Delete a member.
     *
     * @param User $user
     */
    public function removeMember($user)
    {
        $id = is_numeric($user) ? $user : $user->id;

        $this->members()->where('user_id', $id)->first()->delete();
    }

    /**
     * Has member.
     *
     * @param User $user
     *
     * @return bool
     */
    public function hasMember($user): bool
    {
        $id = is_numeric($user) ? $user : $user->id;

        return $this->members()->where('user_id', $id)->count() > 0;
    }

    /**
     * The amount of members assigned to this model.
     *
     * @return mixed
     */
    public function memberCount(): int
    {
        return $this->members()->count();
    }

    /**
     * The amount of members assigned to this model.
     *
     * @return mixed
     */
    public function scopeWithMemberAccess($builder)
    {
        return $builder->whereHas('members', fn ($query) => $query->where('user_id', Auth::id()));
    }

    /**
     * Return parent model to access.
     * @return null
     */
    public function parent()
    {
        return null;
    }
}
