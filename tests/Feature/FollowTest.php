<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class FollowTest extends TestCase
{
    /** @test */
    public function user_can_follow_another_user()
    {
        $follower = factory(User::class)->create(['email'=> 'adam@email.com']);
        $beautifulGirl = factory(User::class)->create(['email'=> 'beatiful.girl@email.com']);

        //this should be changed to POST api/followings
        $response = $this->actingAs($follower)
            ->json('post', 'api/followers', $beautifulGirl->only('id'));

        $response->assertOk();
        $response->assertJsonStructure([
            'message'
        ]);

        $expectedFollower = [
            'follower_id' => $follower->id,
            'following_id' => $beautifulGirl->id
        ];
        $this->assertDatabaseHas('followers', $expectedFollower);
    }

    /** @test */
    public function it_can_return_error_when_following_a_non_existing_user()
    {
        $follower = factory(User::class)->create(['email'=> 'adam@email.com']);
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
