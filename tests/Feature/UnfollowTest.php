<?php

namespace Tests\Feature;

use Facades\Tests\Factories\UserFactory;
use Tests\TestCase;

class UnfollowTest extends TestCase
{
    /** @test */
    public function user_can_unfollow_user_he_follows()
    {
        $followerUser = UserFactory::withFollowing()->create();
        $followingUser = $followerUser->followings->first();

        // make sure $followerUser is really following the $followingUser before we unfollow
        $this->assertTrue($followerUser->isFollowing($followingUser));

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
        $followerUser = UserFactory::withFollowing(1)->create();
        $otherUser = UserFactory::withFollower()->create();

        $response = $this->actingAs($followerUser)
            ->json('delete', '/api/followings/' . $otherUser->id);

        $response->assertNotFound();

        $this->assertDatabaseHas('followers', [
            'following_id' => $otherUser->id
        ]);
    }
}
