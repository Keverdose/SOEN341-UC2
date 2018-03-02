<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $connection = 'sqlite';
    protected $primaryKey = 'id';
    protected $table = 'comment';
    protected $fillable = [
        'comment'
    ];

       public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
