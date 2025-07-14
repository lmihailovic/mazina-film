<?php

namespace App\Policies;

use App\Models\Film;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilmPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the film can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the film can view the model.
     */
    public function view(User $user, Film $model): bool
    {
        return true;
    }

    /**
     * Determine whether the film can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the film can update the model.
     */
    public function update(User $user, Film $model): bool
    {
        return true;
    }

    /**
     * Determine whether the film can delete the model.
     */
    public function delete(User $user, Film $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the film can restore the model.
     */
    public function restore(User $user, Film $model): bool
    {
        return false;
    }

    /**
     * Determine whether the film can permanently delete the model.
     */
    public function forceDelete(User $user, Film $model): bool
    {
        return false;
    }
}
