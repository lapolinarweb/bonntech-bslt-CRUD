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

Route::group(['prefix'=>'bonntech/api/users', 'middleware'=>['cors']],function(){
    Route::get('/', 'UserController@getAllUsers');
    Route::get('{id}','UserController@getUser');
    Route::post('create','UserController@createUser');
    Route::post('save','UserController@updateUser');
    Route::post('delete','UserController@deleteUser');
});
