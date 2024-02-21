<?php

namespace App\Policies;

use App\Models\Audit;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use id;

class AuditPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, $id): bool
    {
        $audit = Audit::find($id);
        if ($user->hasPermissionTo('View Audit') && $user->id === $audit->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Audit $audit): bool
    {
        if ($user->hasPermissionTo('View Audit')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->hasPermissionTo('Add Audit')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Audit $audit): bool
    {
        if ($user->hasPermissionTo('Edit Audit')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Audit $audit): bool
    {
        if ($user->hasPermissionTo('Delete Audit')) {
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
