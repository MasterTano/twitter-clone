<?php

namespace Tests\Feature;

use App\Follower;
use App\Tweet;
use App\User;
use Tests\TestCase;

class TweetTest extends TestCase
{
    /** @test */
    public function user_can_create_a_tweet()
    {
        $user = factory(User::class)->create();
        $tweet = factory(Tweet::class)->make();

        $response = $this->actingAs($user)
            ->json('post', '/api/tweets', $tweet->only('body'));

        $tweetToAssert = $user->tweets->first()->only(['id', 'user_id', 'body']);
        $this->assertDatabaseHas('tweets', $tweetToAssert);
    }

    /** @test */
    public function user_can_see_tweets_of_users_he_follows()
    {
        // create a follower user
        $follower = factory(User::class)->create();

        // follow users
        $followings = factory(Follower::class, 3)->create(['follower_id' => $follower->id]);

        // create tweets for users that $follower is following
        $followings->each(function ($following) {
            $tweets = factory(Tweet::class, 3)->create(['user_id' => $following->following_id]);
        });

        // call api get /api/tweets
        $response = $this->actingAs($follower)
            ->json('get', '/api/tweets');

        $response->assertOk();
        $response->assertJsonCount(9);
        $response->assertJsonStructure([['id', 'user_id', 'body', 'created_at', 'updated_at']]);
    }

    /** @test */
    public function user_can_see_tweets_of_a_specific_user()
    {
        $user = factory(User::class)->create();
        $tweets = factory(Tweet::class, 3)->create(['user_id' => $user->id]);
        factory(Tweet::class, 3)->create();

        $response = $this->actingAs($user)
            ->json('get', '/api/tweets/users/' . $user->id);

        $response->assertOk();
        $response->assertJsonCount(3);
        $response->assertJsonStructure([['id', 'user_id', 'body', 'created_at', 'updated_at']]);
    }
}
