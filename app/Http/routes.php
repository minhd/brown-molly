<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'api', 'middleware' => 'cors'], function(){

    // Users
    Route::model('users', 'App\User');
    Route::resource('users', 'UserController');

    // Tasks
    Route::model('tasks', 'App\Task');
    Route::resource('tasks','TaskController');

    // Lists
    Route::model('lists', 'App\UserList');
    Route::resource('lists','UserListController');

    // Users -> Lists
    Route::resource('users.lists', 'UserListRelationController');

    // todo dynamically generate list of resource routes here
    Route::get('/', function(){
        return ['users', 'tasks', 'lists'];
    });

});

/**
 * api/v1 will now require
 * X-Requested-With=XMLHttpRequest
 * api_token authentication
 * api_token will authenticate to the user who owns that token
 * @todo only allow to deal with owned resource
 * @todo throttle
 */
Route::group(['prefix'=> 'api/v1', 'middleware' => 'auth:api, cors'], function() {

    // api/v1/
    Route::get('/', function(){
        return Auth::guard('api')->user();
    });

    Route::get('users/{user}', function(App\User $user) {
        return $user;
    });
});

use Faker\Factory as Faker;
Route::get('/populate', function(){
    $faker = Faker::create();
    foreach (range(1,10) as $index) {
        $user = new App\User([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => bcrypt('abc123')
        ]);
        $user->save();
    }
});
