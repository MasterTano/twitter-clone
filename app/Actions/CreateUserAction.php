<?php

namespace App\Actions;

use App\User;

class CreateUserAction
{
    public function execute($user)
    {
        return User::create($user);
    }
}