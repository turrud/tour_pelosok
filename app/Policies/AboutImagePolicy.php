<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AboutImage;
use Illuminate\Auth\Access\HandlesAuthorization;

class AboutImagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the aboutImage can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list aboutimages');
    }

    /**
     * Determine whether the aboutImage can view the model.
     */
    public function view(User $user, AboutImage $model): bool
    {
        return $user->hasPermissionTo('view aboutimages');
    }

    /**
     * Determine whether the aboutImage can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create aboutimages');
    }

    /**
     * Determine whether the aboutImage can update the model.
     */
    public function update(User $user, AboutImage $model): bool
    {
        return $user->hasPermissionTo('update aboutimages');
    }

    /**
     * Determine whether the aboutImage can delete the model.
     */
    public function delete(User $user, AboutImage $model): bool
    {
        return $user->hasPermissionTo('delete aboutimages');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete aboutimages');
    }

    /**
     * Determine whether the aboutImage can restore the model.
     */
    public function restore(User $user, AboutImage $model): bool
    {
        return false;
    }

    /**
     * Determine whether the aboutImage can permanently delete the model.
     */
    public function forceDelete(User $user, AboutImage $model): bool
    {
        return false;
    }
}
