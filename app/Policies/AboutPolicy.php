<?php

namespace App\Policies;

use App\Models\User;
use App\Models\About;
use Illuminate\Auth\Access\HandlesAuthorization;

class AboutPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the about can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list abouts');
    }

    /**
     * Determine whether the about can view the model.
     */
    public function view(User $user, About $model): bool
    {
        return $user->hasPermissionTo('view abouts');
    }

    /**
     * Determine whether the about can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create abouts');
    }

    /**
     * Determine whether the about can update the model.
     */
    public function update(User $user, About $model): bool
    {
        return $user->hasPermissionTo('update abouts');
    }

    /**
     * Determine whether the about can delete the model.
     */
    public function delete(User $user, About $model): bool
    {
        return $user->hasPermissionTo('delete abouts');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete abouts');
    }

    /**
     * Determine whether the about can restore the model.
     */
    public function restore(User $user, About $model): bool
    {
        return false;
    }

    /**
     * Determine whether the about can permanently delete the model.
     */
    public function forceDelete(User $user, About $model): bool
    {
        return false;
    }
}
