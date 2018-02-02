<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $connection = 'sqlite';
    protected $primaryKey = 'id';
    protected $table = 'Posts';
    protected $fillable = [
        'title', 'body'
    ];

    public $timestamps = true;

    function user() {
        return $this->belongsTo(User::class);
    }
    function votes(){
        return $this->belongsToMany(User::class, 'users_posts', 'post_id', 'user_id')->withPivot('is_upvote');
    }

}
