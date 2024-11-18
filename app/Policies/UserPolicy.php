<?php

namespace App\Policies;

use App\Models\Contribuyente;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('ver contribuyentes');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Contribuyente $model): bool
    {
        return $user->can('ver contribuyentes');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('crear contribuyentes');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Contribuyente $model): bool
    {
        return $user->can('editar contribuyentes');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Contribuyente $model): bool
    {
        return $user->can('eliminar contribuyentes');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Contribuyente $model): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Contribuyente $model): bool
    {
        //
    }
}
