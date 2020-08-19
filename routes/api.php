<?php

use App\Http\Controllers\Api\WebhookController;
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

Route::group(['prefix' => 'api'], function () {
    Route::group(['middleware' => 'auth:sanctum', 'as' => 'api.'], function () {
        Route::group(['as' => 'settings.', 'namespace' => 'Api'], function () {
            Route::get('/settings', ['uses' => 'SettingController@index'])->name('get');
        });
    });
});

Route::group(['middleware' => ['api']], function () {
    Route::post('/webhook', '\\' . WebhookController::class);
    Route::post('/webhook/{type}', '\\' . WebhookController::class)->name('webhook');
});
