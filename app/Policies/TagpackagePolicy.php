<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tagpackage;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagpackagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the tagpackage can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list tagpackages');
    }

    /**
     * Determine whether the tagpackage can view the model.
     */
    public function view(User $user, Tagpackage $model): bool
    {
        return $user->hasPermissionTo('view tagpackages');
    }

    /**
     * Determine whether the tagpackage can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create tagpackages');
    }

    /**
     * Determine whether the tagpackage can update the model.
     */
    public function update(User $user, Tagpackage $model): bool
    {
        return $user->hasPermissionTo('update tagpackages');
    }

    /**
     * Determine whether the tagpackage can delete the model.
     */
    public function delete(User $user, Tagpackage $model): bool
    {
        return $user->hasPermissionTo('delete tagpackages');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete tagpackages');
    }

    /**
     * Determine whether the tagpackage can restore the model.
     */
    public function restore(User $user, Tagpackage $model): bool
    {
        return false;
    }

    /**
     * Determine whether the tagpackage can permanently delete the model.
     */
    public function forceDelete(User $user, Tagpackage $model): bool
    {
        return false;
    }
}
