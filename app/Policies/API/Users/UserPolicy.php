<?php

namespace App\Policies\API\Users;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function create(User $user)
    {
        if ($user->can('create users')) {
            return true;
        }
    }
}
