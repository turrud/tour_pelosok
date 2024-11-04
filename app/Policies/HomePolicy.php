<?php

namespace App\Policies;

use App\Models\Home;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HomePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the home can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list homes');
    }

    /**
     * Determine whether the home can view the model.
     */
    public function view(User $user, Home $model): bool
    {
        return $user->hasPermissionTo('view homes');
    }

    /**
     * Determine whether the home can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create homes');
    }

    /**
     * Determine whether the home can update the model.
     */
    public function update(User $user, Home $model): bool
    {
        return $user->hasPermissionTo('update homes');
    }

    /**
     * Determine whether the home can delete the model.
     */
    public function delete(User $user, Home $model): bool
    {
        return $user->hasPermissionTo('delete homes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete homes');
    }

    /**
     * Determine whether the home can restore the model.
     */
    public function restore(User $user, Home $model): bool
    {
        return false;
    }

    /**
     * Determine whether the home can permanently delete the model.
     */
    public function forceDelete(User $user, Home $model): bool
    {
        return false;
    }
}
