<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can restore the product.
     */
    public function restore(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can permanently delete the product.
     */
    public function forceDelete(User $user): bool
    {
        return $user->is_admin;
    }
}
