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


Route::group(['prefix'=>'bonntech/api/users', 'middleware'=>['cors']],function(){
    Route::get('/', 'UserController@getAllUsers');
    Route::get('{id}','UserController@getUser');
    Route::post('create','UserController@createUser');
    Route::post('save','UserController@updateUser');
    Route::post('delete','UserController@deleteUser');
});
