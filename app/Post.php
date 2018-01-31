<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $connection = 'sqlite';
    protected $primaryKey = 'id';
    protected $table = 'Posts';
    protected $fillable = [
        'user_id',
        'title',
        'body'
    ];

    public $timestamps = true;

}
