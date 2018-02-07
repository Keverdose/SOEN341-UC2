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

Route::group(['prefix' => 'post','middleware' => ['auth']], function () {

    Route::get('/create', 'PostController@create');
    Route::post('/', 'PostController@store');
    //Route::get('/{post}/{vote}', 'PostController@vote')->where('vote', '(up|down)');


});


//Route::get('/create', 'PageController@create_post');
Route::get('/open_posts', 'PostController@index');
//
//Route::post('/create', 'PostController@store');

Route::post('comments/{post_id}',['uses'=>'CommentController@store','as' =>'comments.store']);