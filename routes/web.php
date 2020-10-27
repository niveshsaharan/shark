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
    Route::get('/', [\App\Http\Controllers\SampleController::class, 'index'])->name('home');

    Route::group(['as' => 'setting.', 'prefix' => '/settings'], function () {
        Route::get('/', [\App\Http\Controllers\SampleController::class, 'indexSetting'])->name('index');
        Route::put('/', [\App\Http\Controllers\SampleController::class, 'updateSetting'])->name('update');
    });
});

// Redirect to app store
Route::redirect('/appstore', 'https://apps.shopify.com/'.config('shark.app_slug'))->name('appstore');

// Webhooks routes to process Shopify webhooks
Route::post('/webhook', \App\Http\Controllers\WebhookController::class);
Route::post('/webhook/{type}', \App\Http\Controllers\WebhookController::class)->name('webhook');
