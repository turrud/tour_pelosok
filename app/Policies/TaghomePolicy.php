<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Taghome;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaghomePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the taghome can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list taghomes');
    }

    /**
     * Determine whether the taghome can view the model.
     */
    public function view(User $user, Taghome $model): bool
    {
        return $user->hasPermissionTo('view taghomes');
    }

    /**
     * Determine whether the taghome can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create taghomes');
    }

    /**
     * Determine whether the taghome can update the model.
     */
    public function update(User $user, Taghome $model): bool
    {
        return $user->hasPermissionTo('update taghomes');
    }

    /**
     * Determine whether the taghome can delete the model.
     */
    public function delete(User $user, Taghome $model): bool
    {
        return $user->hasPermissionTo('delete taghomes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete taghomes');
    }

    /**
     * Determine whether the taghome can restore the model.
     */
    public function restore(User $user, Taghome $model): bool
    {
        return false;
    }

    /**
     * Determine whether the taghome can permanently delete the model.
     */
    public function forceDelete(User $user, Taghome $model): bool
    {
        return false;
    }
}
