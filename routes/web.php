<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth.shopify']], function () {
    Route::get('/', 'SampleController@index')->name('home');

    Route::group(['as' => 'setting.', 'prefix' => '/settings'], function () {
        Route::get('/', 'SampleController@indexSetting')->name('index');
        Route::put('/', 'SampleController@updateSetting')->name('update');
    });
});
