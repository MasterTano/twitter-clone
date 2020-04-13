<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/users', function (Request $request) {
        return response()->json($request->user());
    });

    Route::apiResource("followers", "FollowerController")->only([
        'index',
        'store'
    ]);

    // Route::get('followers', 'FollowerController@index');
    // Route::post('followers', 'FollowerController@store');

    Route::delete('followings/{id}', 'FollowingController@destroy');

    // tweets
    Route::get('tweets', 'TweetController@index');
    Route::post('tweets', 'TweetController@store');

    //tweets/user
    Route::get('tweets/users/{id}', 'UserTweetController@index');


});

Route::post('/login', 'LoginController@authenticate');

Route::post('/users', 'UserController@store');


