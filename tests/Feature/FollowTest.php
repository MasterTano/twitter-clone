<?php

namespace Tests\Feature;

use Facades\Tests\Factories\UserFactory;
use Illuminate\Http\Response;
use Tests\TestCase;

class FollowTest extends TestCase
{
    /** @test */
    public function user_can_follow_another_user()
    {
        $follower = UserFactory::create();
        $following = UserFactory::create();

        //this should be changed to POST api/followings
        $response = $this->actingAs($follower)
            ->json('post', 'api/followers', $following->only('id'));

        $response->assertOk();
        $response->assertJsonStructure([
            'message'
        ]);

        $expectedFollower = [
            'follower_id' => $follower->id,
            'following_id' => $following->id
        ];
        $this->assertDatabaseHas('followers', $expectedFollower);
        $this->assertTrue($follower->isFollowing($following));
    }

    /** @test */
    public function it_can_return_error_when_following_a_non_existing_user()
    {
        $follower = UserFactory::create();
        $nonExistingUserId = 1000;

        // TODO: this should be changed to POST api/followings
        $response = $this->actingAs($follower)
            ->json('post', 'api/followers', ['id' => $nonExistingUserId]);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJsonStructure([
            'message',
        ]);
    }
}
