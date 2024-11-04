<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tagabout;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagaboutPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the tagabout can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list tagabouts');
    }

    /**
     * Determine whether the tagabout can view the model.
     */
    public function view(User $user, Tagabout $model): bool
    {
        return $user->hasPermissionTo('view tagabouts');
    }

    /**
     * Determine whether the tagabout can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create tagabouts');
    }

    /**
     * Determine whether the tagabout can update the model.
     */
    public function update(User $user, Tagabout $model): bool
    {
        return $user->hasPermissionTo('update tagabouts');
    }

    /**
     * Determine whether the tagabout can delete the model.
     */
    public function delete(User $user, Tagabout $model): bool
    {
        return $user->hasPermissionTo('delete tagabouts');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete tagabouts');
    }

    /**
     * Determine whether the tagabout can restore the model.
     */
    public function restore(User $user, Tagabout $model): bool
    {
        return false;
    }

    /**
     * Determine whether the tagabout can permanently delete the model.
     */
    public function forceDelete(User $user, Tagabout $model): bool
    {
        return false;
    }
}
