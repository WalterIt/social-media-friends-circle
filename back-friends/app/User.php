<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'lastName', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];


    public function posts()
    {
        return $this->hasMany('App\Post', 'author_id');
    }


    public function friends()
    {
        // MANY TO MANY RELATIONSHIP
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id');
    }

    public function hasFriendWithId($userId)
    {
        // CHECK IF THE FRIENDS IS ALREADY IN THE RELATIONSHIP
        return $this->friends->contains($userId);
    }

    public function addFriendById($friendId)
    {
        // ADD FRIENDS TO THE COLLECTION
        $this->friends()->attach($friendId);

        $friend = User::find($friendId);
        $friend->friends()->attach($this->id);
    }

    public function removeFriendById($friendId)
    {
        $this->friends()->detach($friendId);

        $friend = User::find($friendId);
        $friend->friends()->detach($this->id);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
