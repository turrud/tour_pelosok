<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tagexplore;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagexplorePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the tagexplore can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list tagexplores');
    }

    /**
     * Determine whether the tagexplore can view the model.
     */
    public function view(User $user, Tagexplore $model): bool
    {
        return $user->hasPermissionTo('view tagexplores');
    }

    /**
     * Determine whether the tagexplore can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create tagexplores');
    }

    /**
     * Determine whether the tagexplore can update the model.
     */
    public function update(User $user, Tagexplore $model): bool
    {
        return $user->hasPermissionTo('update tagexplores');
    }

    /**
     * Determine whether the tagexplore can delete the model.
     */
    public function delete(User $user, Tagexplore $model): bool
    {
        return $user->hasPermissionTo('delete tagexplores');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete tagexplores');
    }

    /**
     * Determine whether the tagexplore can restore the model.
     */
    public function restore(User $user, Tagexplore $model): bool
    {
        return false;
    }

    /**
     * Determine whether the tagexplore can permanently delete the model.
     */
    public function forceDelete(User $user, Tagexplore $model): bool
    {
        return false;
    }
}
