<?php

namespace Tests\Feature;

use App\Follower;
use App\User;
use Tests\TestCase;

class FollowerTest extends TestCase
{
    /** @test */
    public function user_can_see_list_of_users_that_follows_him()
    {
        // create a user
        $user = factory(User::class)->create();
        // create followers for that user
        $followers = factory(Follower::class, 5)->create(['following_id' => $user->id]);
        // extra 10 users (follower 5, following 5)
        factory(Follower::class, 5)->create();

        $response = $this->actingAs($user)
            ->json('get', '/api/followers');

        // assertions
        $response->assertOk();
        $response->assertJsonCount(5);
        $response->assertJsonStructure([
            ['id', 'first_name', 'last_name', 'email', 'created_at', 'updated_at']
        ]);
    }
}
