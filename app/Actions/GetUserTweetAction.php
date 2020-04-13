<?php

namespace App\Actions;

use App\Tweet;
use App\User;

class GetUserTweetAction
{
    public function execute(int $userId)
    {
        User::find($userId);
        $tweets = Tweet::where('user_id', $userId)->limit(100)-> get();
        return $tweets;
    }
}