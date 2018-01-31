<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'Post';
    protected $fillable = array(
        'user_id',
        'title',
        'body'
    );

    public $timestamps = true;

}
