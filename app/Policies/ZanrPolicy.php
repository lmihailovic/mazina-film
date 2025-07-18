<?php

namespace App\Policies;

use App\Models\Zanr;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ZanrPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the zanr can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the zanr can view the model.
     */
    public function view(User $user, Zanr $model): bool
    {
        return true;
    }

    /**
     * Determine whether the zanr can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin' || $user->role === 'rukovodilac';
    }

    /**
     * Determine whether the zanr can update the model.
     */
    public function update(User $user, Zanr $model): bool
    {
        return $user->role === 'admin' || $user->role === 'rukovodilac';
    }

    /**
     * Determine whether the zanr can delete the model.
     */
    public function delete(User $user, Zanr $model): bool
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
     * Determine whether the zanr can restore the model.
     */
    public function restore(User $user, Zanr $model): bool
    {
        return false;
    }

    /**
     * Determine whether the zanr can permanently delete the model.
     */
    public function forceDelete(User $user, Zanr $model): bool
    {
        return false;
    }
}
