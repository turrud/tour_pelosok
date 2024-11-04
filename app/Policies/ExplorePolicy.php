<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Explore;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExplorePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the explore can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list explores');
    }

    /**
     * Determine whether the explore can view the model.
     */
    public function view(User $user, Explore $model): bool
    {
        return $user->hasPermissionTo('view explores');
    }

    /**
     * Determine whether the explore can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create explores');
    }

    /**
     * Determine whether the explore can update the model.
     */
    public function update(User $user, Explore $model): bool
    {
        return $user->hasPermissionTo('update explores');
    }

    /**
     * Determine whether the explore can delete the model.
     */
    public function delete(User $user, Explore $model): bool
    {
        return $user->hasPermissionTo('delete explores');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete explores');
    }

    /**
     * Determine whether the explore can restore the model.
     */
    public function restore(User $user, Explore $model): bool
    {
        return false;
    }

    /**
     * Determine whether the explore can permanently delete the model.
     */
    public function forceDelete(User $user, Explore $model): bool
    {
        return false;
    }
}
