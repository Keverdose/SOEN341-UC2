<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name','email', 'password',
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
      * Concats first name and last name together.
      */
    public function fullName() {
      return $this->first_name . ' ' . $this->last_name;
    }

    function posts(){
        return $this->hasMany(Post::class);
    }

    function votes(){
        return $this->belongsToMany(Post::class, 'users_posts', 'user_id', 'post_id')->withPivot('is_upvote');
    }

}
