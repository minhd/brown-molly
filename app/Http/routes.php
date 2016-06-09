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

    // define the models
    Route::model('users', 'App\User');
    Route::model('tasks', 'App\Task');

    //define the resource routes
    Route::resource('users', 'UserController');
    Route::resource('tasks','TaskController');

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
