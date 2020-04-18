<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followings()
    {
        return $this->belongsToMany(
            User::class,
            'followers',
            'follower_id',
            'following_id'
        );
    }

    public function followers()
    {
        return $this->belongsToMany(
            User::class,
            'followers',
            'following_id',
            'follower_id'
        );
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    /**
     * @param Tweet $tweet
     * @return false|\Illuminate\Database\Eloquent\Model
     */
    public function addTweet(Tweet $tweet)
    {
        return $this->tweets()->save($tweet);
    }

    /**
     * Follow a user
     * @param User $user
     * @return false|\Illuminate\Database\Eloquent\Model
     */
    public function follow(User $user)
    {
        return $this->followings()->save($user);
    }

    /**
     * Un follow a user you follow
     * @param User $user
     * @return mixed
     */
    public function unFollow(User $user)
    {
        return $this->followings()->detach($user);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isFollowing(User $user) : bool
    {
        return $this->followings()->where('following_id', $user->id)->count('following_id')
            ? true : false;
    }
}
