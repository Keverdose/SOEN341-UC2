<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->integer('user_id');
            $table->string('name');
            $table->text('comment');
            $table->timestamps();

            
        });

        Schema::table('comments',function($table){
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table){
          $table->dropForeign(['user_id']);
          $table->dropForeign(['post_id']);
        });
        Schema::dropIfExists('comment');
//        Schema::dropForeign(['post_id']);
//        Schema::dropForeign(['user_id']);
    }
}
