<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\Petition;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{

    public function before(User $user)
    {
        if($user->admin == 1) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return true;
    }
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if($user->admin == 1) {
            return true;
        }
        return false;
    }
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        if($user->admin == 1) {
            return true;
        }
        return false;
    }
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Petition $petition): bool {
        if($user->admin == 1) {
            return true;
        }
        return false;
    }

//    /**
//     * Determine whether the user can view any models.
//     */
//    public function viewAny(User $user): bool
//    {
//        return false;
//    }
//
//    /**
//     * Determine whether the user can restore the model.
//     */
//    public function restore(User $user, Petition $petition): bool
//    {
//        return false;
//    }
//
//    /**
//     * Determine whether the user can permanently delete the model.
//     */
//    public function forceDelete(User $user, Petition $petition): bool
//    {
//        return false;
//    }
}
