<?php

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('product', 'ProductController')->except(['show']);
    Route::resource('role', 'RoleController')->except(['show']);
    Route::resource('user', 'UserController')->except(['show']);
});