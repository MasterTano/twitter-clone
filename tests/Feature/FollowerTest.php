<?php

namespace Tests\Feature;

use Facades\Tests\Factories\UserFactory;
use Tests\TestCase;

class FollowerTest extends TestCase
{
    /** @test */
    public function user_can_see_list_of_his_followers()
    {
        // create 5 other users that does not follow him
        UserFactory::create(5);

        // create a user with 5 followers
        $user = UserFactory::withFollower(5)->create();

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
