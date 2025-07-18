<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Scena;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScenaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the scena can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the scena can view the model.
     */
    public function view(User $user, Scena $model): bool
    {
        return true;
    }

    /**
     * Determine whether the scena can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin' || $user->role === 'rukovodilac';
    }

    /**
     * Determine whether the scena can update the model.
     */
    public function update(User $user, Scena $model): bool
    {
        return $user->role === 'admin' || $user->role === 'rukovodilac';
    }

    /**
     * Determine whether the scena can delete the model.
     */
    public function delete(User $user, Scena $model): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the scena can restore the model.
     */
    public function restore(User $user, Scena $model): bool
    {
        return false;
    }

    /**
     * Determine whether the scena can permanently delete the model.
     */
    public function forceDelete(User $user, Scena $model): bool
    {
        return false;
    }
}
