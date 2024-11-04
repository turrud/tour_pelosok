<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PackageImage;
use Illuminate\Auth\Access\HandlesAuthorization;

class PackageImagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the packageImage can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list packageimages');
    }

    /**
     * Determine whether the packageImage can view the model.
     */
    public function view(User $user, PackageImage $model): bool
    {
        return $user->hasPermissionTo('view packageimages');
    }

    /**
     * Determine whether the packageImage can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create packageimages');
    }

    /**
     * Determine whether the packageImage can update the model.
     */
    public function update(User $user, PackageImage $model): bool
    {
        return $user->hasPermissionTo('update packageimages');
    }

    /**
     * Determine whether the packageImage can delete the model.
     */
    public function delete(User $user, PackageImage $model): bool
    {
        return $user->hasPermissionTo('delete packageimages');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete packageimages');
    }

    /**
     * Determine whether the packageImage can restore the model.
     */
    public function restore(User $user, PackageImage $model): bool
    {
        return false;
    }

    /**
     * Determine whether the packageImage can permanently delete the model.
     */
    public function forceDelete(User $user, PackageImage $model): bool
    {
        return false;
    }
}
