<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/users/query', 'UserApiController@query')->name('user-query');

//LikeDislike
Route::post('/like','ReviewController@like')->name('like');
Route::post('/dislike','ReviewController@dislike')->name('dislike');