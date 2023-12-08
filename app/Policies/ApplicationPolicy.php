<?php

namespace App\Policies;

use App\Models\Application;
use App\Models\User;

class ApplicationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list applications');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Application $application): bool
    {
        return $user->hasPermissionTo('view applications');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create applications');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Application $application): bool
    {
        return $user->hasPermissionTo('update applications');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Application $application): bool
    {
        return $user->hasPermissionTo('delete applications');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Application $application): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Application $application): bool
    {
        return false;
    }
}
