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

        Route::get('/product', 'API\ProductController@index')->name('api.product.list');
        Route::post('/product/create', 'API\ProductController@store')->name('api.product.create');
        Route::put('/product/update/{id}', 'API\ProductController@update')->name('api.product.update');
        Route::delete('/product/delete/{id}', 'API\ProductController@destroy')->name('api.product.delete');
        Route::get('/product/{id}', 'API\ProductController@show')->name('api.product');
    });

    Route::post('/register', 'API\AuthController@register')->name('register.api');

    Route::post('/login', 'API\AuthController@login')->name('login.api');
});


