<?php

namespace App\Actions;

use App\Exceptions\UnfollowUserNotFoundException;
use App\User;

class UnfollowUserAction
{
    public function execute(User $follower, User $following)
    {
        // check if the user is really following the $following
        if (!$follower->isFollowing($following)) {
            throw new UnfollowUserNotFoundException("Cannot unfollow user you are not following", 404);
        }

        return $follower->unFollow($following);
    }
}
