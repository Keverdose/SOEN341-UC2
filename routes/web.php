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

Route::post('comment/{comment}/deleted', 'CommentController@delete')->name('comment.delete');
Route::post('comment/{comment}/destroyed', 'CommentController@destroy')->name('comment.destroy');

Route::post('post/{post}/deleted', 'PostController@delete')->name('post.delete');
Route::post('post/{post}/destroyed', 'PostController@destroy')->name('post.destroy');


Route::get('/{user_id}/user_activity', 'PageController@user_act')->name('user.activity');

Route::group(['prefix' => 'post','middleware' => ['auth']], function () {
    Route::get('/{post}/post_reopen', 'PostController@reopen')->name('post.reopen');
    Route::get('/{post}/post_edit', 'PostController@edit')->name('post.edit');
    
    Route::get('/{comment}/comment_edit', 'CommentController@edit')->name('comment.edit');
    Route::get('/{comment}/comment_answer', 'CommentController@mark_answer')->name('comment.answer');

    Route::get('/{comment}/comment_delete', 'CommentController@delete')->name('comment.delete');
    Route::get('/{comment}/comment_destroy', 'CommentController@destroy')->name('comment.destroy');

    Route::get('/{post}/post_destroy', 'PostController@destroy')->name('post.destroy');
    Route::get('/{post}/post_delete', 'PostController@delete')->name('post.delete');

    Route::get('/create', 'PostController@create')->name('post.create');
    Route::post('/', 'PostController@store');
    Route::get('/{post}', 'PostController@show')->name('post.show');
    Route::post('/create/createCategory/store', 'CategoryController@store')->name('categories.store');
    Route::get('/create/createCategory','CategoryController@createCategory')->name('categories.create');
    Route::get('/{post}/{vote}', 'PostController@vote')->where('vote', '(up|down)')->name('answer.vote');
});

Route::get('/{status}/posts', 'PostController@index')->name('posts.list');

Route::post('comments/{post}','CommentController@store')->name('comments.store');