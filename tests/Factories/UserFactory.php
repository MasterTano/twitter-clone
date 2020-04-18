<?php

namespace Tests\Factories;

use App\Follower;
use App\User;

class UserFactory extends BaseFactory
{
    public $followingCount = 0;
    public $followerCount = 0;

    public function withFollowing(int $followingCount = 1)
    {
        $this->followingCount = $followingCount;
        return $this;
    }

    public function withFollower(int $followerCount = 1)
    {
        $this->followerCount = $followerCount;
        return $this;
    }

    public function create($count = 1, $overrides = [])
    {
        \Facades\FactoryName::clearResolvedInstance(self::class);

        $this->count = $count;

        $users = factory(User::class, $this->count)->create($overrides);

        if ($this->followingCount) {
            $users->each(function ($user) {
                factory(Follower::class, $this->followingCount)->create([
                    'follower_id' => $user->id
                ]);
            });
        }

        if ($this->followerCount) {
            $users->each(function ($user) {
                factory(Follower::class, $this->followerCount)->create([
                    'following_id' => $user->id
                ]);
            });
        }

        return $this->collectionOrModel($users);
    }
}