<?php

namespace App\Policies;

use App\Models\Audit;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AuditPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasRole(['Super Admin', 'Admin', 'Auditor'])) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Audit $audit): bool
    {
        if ($user->hasRole(['Super Admin', 'Admin'])) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->hasRole(['Super Admin', 'Admin', 'Auditor'])) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Audit $audit): bool
    {
        if ($user->hasRole(['Super Admin', 'Auditor', 'Auditor'])) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Audit $audit): bool
    {
        if ($user->hasRole(['Super Admin', 'Auditor'])) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, Audit $audit): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can permanently delete the model.
     */
    // public function forceDelete(User $user, Audit $audit): bool
    // {
    //     //
    // }
}
