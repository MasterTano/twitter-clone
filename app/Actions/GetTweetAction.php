<?php

namespace App\Actions;

use App\User;

class GetTweetAction
{
    public function execute(User $user)
    {
        return $user->tweets()->limit(20)->get();
    }
}