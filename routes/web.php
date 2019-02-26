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

Route::middleware('web')->group(function(){
    Auth::routes();
    Route::get('/', function () {
        return redirect('/login');
    });
});

Route::middleware(['web', 'auth'])->group(function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/tweet', 'TweetController@create');
    Route::get('/', 'TweetController@getTweets');
    Route::get('/users', 'AccountController@getUsers');
    Route::get('/users/{username}', 'AccountController@account');
    Route::get('/users/{username}/followers', 'AccountController@getFollowers');
    Route::get('/users/{username}/following', 'AccountController@getFollowings');
    Route::get('/edit-account', 'AccountController@editAccount');
    Route::put('/update-info', 'AccountController@editUserInfo');
    Route::get('/user/{id}/follow', 'AccountController@followUser');
    Route::get('/{id}/unfollow', 'AccountController@unfollowUser');
});