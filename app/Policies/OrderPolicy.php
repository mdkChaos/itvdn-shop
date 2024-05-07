<?php

namespace App\Policies;

use App\Models\User;

class OrderPolicy
{
     /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user): bool
    {
        return $user->is_admin;
    }
}
