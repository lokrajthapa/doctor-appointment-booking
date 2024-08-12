<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }


    public function create(User $user): bool
    {
        //
    }
    public function edit(User $user, User $model): bool
    {

        return $user->id === $model->id || $user->user_type === 'admin' ;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $user->id === $model->id || $user->user_type === 'admin' ;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user,User $model ): bool
    {

        return $user->user_type === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user): bool
    {
        //
    }
}
