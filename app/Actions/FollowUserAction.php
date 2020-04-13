<?php

namespace App\Actions;

use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FollowUserAction
{
    /**
     * @param User $follower
     * @param int $toFollowUserId
     * @return User|false|\Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function execute(User $follower, int $toFollowUserId)
    {
        $toFollowUser = User::find($toFollowUserId);
        if (!$toFollowUser) {
            throw new ModelNotFoundException('User ' .$toFollowUserId . ' not found');
        }

        return $follower->follow($toFollowUser);
    }
}