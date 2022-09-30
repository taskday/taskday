<?php

namespace Taskday\Policies;

use Taskday\Models\Entry;
use Taskday\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EntryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user
     * @param  Entry  $entry
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Entry $entry)
    {
        if ($user->id === $entry->user_id) {
            return true;
        }

        if ($entry->board->hasMember($user)) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  Entry  $entry
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Entry $entry)
    {
        if ($user->id == $entry->user_id) {
            return true;
        }

        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Entry  $entry
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Entry $entry)
    {
        if ($user->id == $entry->user_id) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  Entry  $entry
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Entry $entry)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  Entry  $entry
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Entry $entry)
    {
        //
    }
}
