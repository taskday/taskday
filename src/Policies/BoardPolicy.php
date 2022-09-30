<?php

namespace Taskday\Policies;

use Taskday\Models\Board;
use Taskday\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BoardPolicy
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
     * @param  Board  $board
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Board $board)
    {
        if ($board->ownerIs($user)) {
            return true;
        }


        if ($board->hasMember($user)) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  Board  $board
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Board $board)
    {
        if ($board->ownerIs($user)) {
            return true;
        }


        if ($board->hasMember($user)) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Board  $board
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Board $board)
    {
        if ($board->ownerIs($user)) {
            return true;
        }


        if ($board->hasMember($user)) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  Board  $board
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Board $board)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  Board  $board
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Board $board)
    {
        //
    }
}
