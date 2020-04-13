<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'follower_id', 'following_id'
    ];

    public function follower()
    {
        return $this->hasOne(User::class, 'id', 'follower_id');
    }

    public function following()
    {
        $this->hasOne(User::class, 'id', 'following_id');
    }
}
