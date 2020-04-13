<?php

namespace App\Actions;

use App\Tweet;
use App\User;

class CreateTweetAction
{
    public function execute(User $user, array $tweet)
    {
        return $user->addTweet(new Tweet($tweet));
    }
}