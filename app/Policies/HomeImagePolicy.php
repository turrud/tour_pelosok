<?php

namespace App\Policies;

use App\Models\User;
use App\Models\HomeImage;
use Illuminate\Auth\Access\HandlesAuthorization;

class HomeImagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the homeImage can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list homeimages');
    }

    /**
     * Determine whether the homeImage can view the model.
     */
    public function view(User $user, HomeImage $model): bool
    {
        return $user->hasPermissionTo('view homeimages');
    }

    /**
     * Determine whether the homeImage can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create homeimages');
    }

    /**
     * Determine whether the homeImage can update the model.
     */
    public function update(User $user, HomeImage $model): bool
    {
        return $user->hasPermissionTo('update homeimages');
    }

    /**
     * Determine whether the homeImage can delete the model.
     */
    public function delete(User $user, HomeImage $model): bool
    {
        return $user->hasPermissionTo('delete homeimages');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete homeimages');
    }

    /**
     * Determine whether the homeImage can restore the model.
     */
    public function restore(User $user, HomeImage $model): bool
    {
        return false;
    }

    /**
     * Determine whether the homeImage can permanently delete the model.
     */
    public function forceDelete(User $user, HomeImage $model): bool
    {
        return false;
    }
}
