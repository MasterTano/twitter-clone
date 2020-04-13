<?php

namespace App\Actions;

use App\User;

class GetFollowerAction
{
    public function execute(User $user)
    {
        return $user->followers()->limit(100)->get();
    }
}
