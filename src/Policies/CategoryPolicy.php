<?php

namespace Taskday\Policies;

use Taskday\Models\Category;
use Taskday\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user
     * @param  Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Category $category)
    {
        if ($category->ownerIs($user)) {
            return true;
        }

        if ($category->boards->map->ownerIs($user)->filter()->count() > 0) {
            return true;
        }


        if ($category->boards->map(fn ($b) => $b->hasMember($user))->filter()->count()) {
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
     * @param  Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Category $category)
    {
        if ($category->ownerIs($user)) {
            return true;
        }


        if ($category->hasMember($user)) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Category $category)
    {
        if ($category->ownerIs($user)) {
            return true;
        }


        if ($category->hasMember($user)) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, Category $category)
    {
        //
    }
}
