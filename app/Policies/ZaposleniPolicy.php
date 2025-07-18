<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Zaposleni;
use Illuminate\Auth\Access\HandlesAuthorization;

class ZaposleniPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the zaposleni can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the zaposleni can view the model.
     */
    public function view(User $user, Zaposleni $model): bool
    {
        return true;
    }

    /**
     * Determine whether the zaposleni can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin' || $user->role === 'rukovodilac';
    }

    /**
     * Determine whether the zaposleni can update the model.
     */
    public function update(User $user, Zaposleni $model): bool
    {
        return $user->role === 'admin' || $user->role === 'rukovodilac';
    }

    /**
     * Determine whether the zaposleni can delete the model.
     */
    public function delete(User $user, Zaposleni $model): bool
    {
        return $user->role === 'admin' || $user->role === 'rukovodilac';
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the zaposleni can restore the model.
     */
    public function restore(User $user, Zaposleni $model): bool
    {
        return false;
    }

    /**
     * Determine whether the zaposleni can permanently delete the model.
     */
    public function forceDelete(User $user, Zaposleni $model): bool
    {
        return false;
    }
}
