<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Paket;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaketPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the paket can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list pakets');
    }

    /**
     * Determine whether the paket can view the model.
     */
    public function view(User $user, Paket $model): bool
    {
        return $user->hasPermissionTo('view pakets');
    }

    /**
     * Determine whether the paket can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create pakets');
    }

    /**
     * Determine whether the paket can update the model.
     */
    public function update(User $user, Paket $model): bool
    {
        return $user->hasPermissionTo('update pakets');
    }

    /**
     * Determine whether the paket can delete the model.
     */
    public function delete(User $user, Paket $model): bool
    {
        return $user->hasPermissionTo('delete pakets');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete pakets');
    }

    /**
     * Determine whether the paket can restore the model.
     */
    public function restore(User $user, Paket $model): bool
    {
        return false;
    }

    /**
     * Determine whether the paket can permanently delete the model.
     */
    public function forceDelete(User $user, Paket $model): bool
    {
        return false;
    }
}
