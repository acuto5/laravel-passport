<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => ['json.response']], function () {

    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('/logout', 'API\AuthController@logout')->name('logout.api');

        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });

    Route::post('/register', 'API\AuthController@register')->name('register.api');

    Route::post('/login', 'API\AuthController@login')->name('login.api');
});


