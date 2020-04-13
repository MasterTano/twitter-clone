<?php

namespace Tests\Feature;

use App\Follower;
use App\User;
use Tests\TestCase;

class UnfollowTest extends TestCase
{
    /** @test */
    public function user_can_unfollow_user_he_follows()
    {
        // create follower user
        $followerModel = factory(Follower::class)->create();
        // get following user
        $followingUser = User::find($followerModel->following_id);
        // get follower user
        $followerUser = User::find($followerModel->follower_id);

        $response = $this->actingAs($followerUser)
            ->json('delete', '/api/followings/' . $followingUser->id);

        // create assertion here
        $response->assertOk();
        // assert that follower id and following id does not exist in followers table
        $this->assertDatabaseMissing('followers', [
            'follower_id' => $followerUser->id,
            'following_id' => $followingUser->id
        ]);
    }

    /** @test */
    public function user_cannot_unfollow_user_he_does_not_follow()
    {
        // create follower user
        $followerModel = factory(Follower::class)->create();
        $otherFollowerModel = factory(Follower::class)->create();
        $followerUser = User::find($followerModel->follower_id);

        $response = $this->actingAs($followerUser)
            ->json('delete', '/api/followings/' . $otherFollowerModel->following_id);

        $response->assertNotFound();

        $this->assertDatabaseHas('followers', [
            'following_id' => $otherFollowerModel->following_id
        ]);
    }
}
