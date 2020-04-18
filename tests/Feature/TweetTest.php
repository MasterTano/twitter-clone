<?php

namespace Tests\Feature;

use App\Tweet;
use App\User;
use Facades\Tests\Factories\TweetFactory;
use Facades\Tests\Factories\UserFactory;
use Tests\TestCase;

class TweetTest extends TestCase
{
    /** @test */
    public function user_can_create_a_tweet()
    {
        $user = factory(User::class)->create();
        $tweet = factory(Tweet::class)->make();

        $response = $this->actingAs($user)->json('post', '/api/tweets', $tweet->only('body'));

        $response->assertOk();

        $tweetToAssert = $user->tweets->first()->only(['id', 'user_id', 'body']);
        $this->assertDatabaseHas('tweets', $tweetToAssert);
    }

    /** @test */
    public function user_can_see_tweets_of_users_he_is_following()
    {
        $user = UserFactory::withFollowing(3)->create();

        $user->followings->each(function ($followingUser) {
            TweetFactory::ownedBy($followingUser)->create(3);
        });

        // call api get /api/tweets
        $response = $this->actingAs($user)->json('get', '/api/tweets');


        $response->assertOk();
        $response->assertJsonCount(9);
        $response->assertJsonStructure([['id', 'user_id', 'body', 'created_at', 'updated_at']]);
    }

    /** @test */
    public function user_can_see_tweets_of_a_specific_user()
    {
        // we create tweets and get the user
        $user = TweetFactory::create(3)->first()->user;

        $response = $this->actingAs($user)->json('get', '/api/tweets/users/' . $user->id);

        $response->assertOk();
        $response->assertJsonCount(3);
        $response->assertJsonStructure([['id', 'user_id', 'body', 'created_at', 'updated_at']]);
    }
}
