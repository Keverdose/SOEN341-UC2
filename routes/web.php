<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');


Auth::routes();

Route::get('/home', 'HomeController@index');
Route::post('post/{post}/updated', 'PostController@update')->name('post.update');
Route::post('comment/{comment}/updated', 'CommentController@update')->name('comment.update');

Route::get('/{user_id}/user_activity', 'PageController@user_act')->name('user.activity');

Route::group(['prefix' => 'post','middleware' => ['auth']], function () {
    Route::get('/{post}/post_edit', 'PostController@edit')->name('post.edit');

    Route::get('/{comment}/comment_edit', 'CommentController@edit')->name('comment.edit');

    Route::get('/create', 'PostController@create');
    Route::post('/', 'PostController@store');
    Route::get('/{post}', 'PostController@show')->name('post.show');
    //Route::get('/{post}/{vote}', 'PostController@vote')->where('vote', '(up|down)');

});

//Route::get('/{comment}/comment_edit', 'CommentController@edit')->name('comment.edit');
//Route::get('/create', 'PageController@create_post');
Route::get('/open_posts', 'PostController@index');
//
//Route::post('/create', 'PostController@store');

Route::post('comments/{post}','CommentController@store')->name('comments.store');