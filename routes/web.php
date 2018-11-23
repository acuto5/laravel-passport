<?php

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('product', 'ProductController')->except(['show']);
});