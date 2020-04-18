<?php

namespace Tests\Factories;

use App\Tweet;
use App\User;

class TweetFactory extends BaseFactory
{
    public $user;

    public function ownedBy(User $user)
    {
        $this->user = $user;
        return $this;
    }

    public function create($count = 1)
    {
        \Facades\FactoryName::clearResolvedInstance(self::class);

        $this->count = $count;

        $tweets = factory(Tweet::class, $this->count)->create([
            'user_id' => $this->user ?? factory(User::class)->create()
        ]);

        return $this->collectionOrModel($tweets);
    }
}