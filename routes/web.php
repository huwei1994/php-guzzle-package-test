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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'Test', 'prefix' => 'test'], function()
{
    Route::get('/hh','TestController@hh');
    Route::get('/jj','TestController@jj');
    Route::get('/mm','TestController@mm');
    Route::get('/kk','TestController@kk');
    Route::get('/nn','TestController@nn');
    Route::get('/qq','TestController@qq');
    Route::get('/po','TestController@po');
});
