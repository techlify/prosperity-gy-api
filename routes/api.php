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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('idea', 'IdeaController@readall');
Route::get('idea/{id}', 'IdeaController@read');



Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'UserController@login');
    Route::post('signup', 'UserController@signup');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'UserController@logout');
        Route::get('user', 'UserController@user');
        Route::post('create-idea', 'IdeaController@create');
        Route::post('update-idea', 'IdeaController@update');
        Route::post('delete-idea', 'IdeaController@delete');
        Route::post('create-writeup', 'WriteupController@create');
        Route::post('update-writeup', 'WriteupController@update');
        Route::post('delete-writeup', 'WriteupController@delete');
        Route::post('create-vote', 'VoteController@storeVote');
        Route::post('get-vote', 'VoteController@userVote');
        Route::resource('category', 'CategoryController');
        Route::post('create-recommendation', 'RecommendationController@create');
        Route::post('update-recommendation', 'RecommendationController@update');
        Route::post('delete-recommendation', 'RecommendationController@delete');
    });
});
