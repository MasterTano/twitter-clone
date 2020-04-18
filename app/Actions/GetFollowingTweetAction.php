<?php

namespace App\Actions;

use App\Tweet;
use App\User;

class GetFollowingTweetAction
{
    public function execute(User $user)
    {
        $followingUsersId = $user->followings->pluck('id');
        return Tweet::with('user')->whereIn('user_id', $followingUsersId)->get();
    }
}
