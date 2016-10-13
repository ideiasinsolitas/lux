<?php

$router->group(['prefix' => 'user', 'namespace' => 'Core'], function () use ($router) {
    Route::get('/', 'UserController@index')->name('core.user.list');
    Route::get('/{pk}', 'UserController@show')->name('core.user.show');
    Route::post('/', 'UserController@store')->name('core.user.save');
});
