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

Route::post('/upload', 'ImageController@upload');

Route::get('/{image}', 'ImageController@image');

Route::group(['prefix' => 'admin'], function()
{
    Route::resource('images', 'ImageController');

    Route::resource('exploits', 'ExploitController');

    Route::resource('fakers', 'FakerController');
});
