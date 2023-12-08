<?php

namespace App\Policies;

use App\Models\KioskParticipant;
use App\Models\User;

class KioskParticipantPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list kiosk participants');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, KioskParticipant $kioskParticipant): bool
    {
        return $user->hasPermissionTo('view kiosk participants');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create kiosk participants');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, KioskParticipant $kioskParticipant): bool
    {
        return $user->hasPermissionTo('update kiosk participants');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, KioskParticipant $kioskParticipant): bool
    {
        return $user->hasPermissionTo('delete kiosk participants');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, KioskParticipant $kioskParticipant): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, KioskParticipant $kioskParticipant): bool
    {
        return false;
    }
}
