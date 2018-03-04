<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
      * Fillable attributes
      */
    protected $fillable = [
        'title', 'body'
    ];

    protected $with = [
        'user'
    ];

    public $timestamps = true;

    function user() {
        return $this->belongsTo(User::class);
    }

    function votes() {
        return $this->belongsToMany(User::class, 'users_posts', 'post_id', 'user_id')->withPivot('is_upvote');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function content() {
        return $this->body;
    }
}
