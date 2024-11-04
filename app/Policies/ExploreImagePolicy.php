<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ExploreImage;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExploreImagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the exploreImage can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list exploreimages');
    }

    /**
     * Determine whether the exploreImage can view the model.
     */
    public function view(User $user, ExploreImage $model): bool
    {
        return $user->hasPermissionTo('view exploreimages');
    }

    /**
     * Determine whether the exploreImage can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create exploreimages');
    }

    /**
     * Determine whether the exploreImage can update the model.
     */
    public function update(User $user, ExploreImage $model): bool
    {
        return $user->hasPermissionTo('update exploreimages');
    }

    /**
     * Determine whether the exploreImage can delete the model.
     */
    public function delete(User $user, ExploreImage $model): bool
    {
        return $user->hasPermissionTo('delete exploreimages');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete exploreimages');
    }

    /**
     * Determine whether the exploreImage can restore the model.
     */
    public function restore(User $user, ExploreImage $model): bool
    {
        return false;
    }

    /**
     * Determine whether the exploreImage can permanently delete the model.
     */
    public function forceDelete(User $user, ExploreImage $model): bool
    {
        return false;
    }
}
