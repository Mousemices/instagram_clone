<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PostController@index')->name('Post.index');

Auth::routes();

Route::group(['prefix' => 'post',  'middleware' => 'auth'], function()
{
    Route::get('create','PostController@create')->name('post.create');
    Route::post('store','PostController@store')->name('post.store');
    Route::delete('{post}','PostController@destroy')->name('post_delete');

});
Route::get('/profile', 'PostController@posts')->name('user.profile')->middleware('auth');
//Route::get('/post/create','PostController@create')->name('post.create')->middleware('auth');
//Route::post('/post/store','PostController@store')->name('post.store')->middleware('auth');
Route::group(['prefix' => 'comment', 'middleware' => 'auth'], function(){
    Route::post('{post}','CommentController@store')->name('comment.store');
    Route::delete('{comment}','CommentController@destroy')->name('comment.delete');
});

//Route::post('/comment/{post}','CommentController@store')->name('comment.store');
//Route::delete('/comment/{comment}','CommentController@destroy')->name('comment.delete');
//Route::delete('post/{post}','PostController@destroy')->name('post_delete')->middleware('auth');

// Tag in posts
Route::get('/tag', 'TagController@index')->name('tag_post');

Route::permanentRedirect('/report', '/');







