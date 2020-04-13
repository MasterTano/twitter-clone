<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Follower;
use App\User;
use Faker\Generator as Faker;

$factory->define(Follower::class, function (Faker $faker) {
    return [
        'follower_id' => factory(User::class),
        'following_id' => factory(User::class)
    ];
});
