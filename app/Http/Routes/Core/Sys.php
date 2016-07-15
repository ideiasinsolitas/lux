<?php

$router->group(['namespace' => 'Sys', 'prefix' => 'sys'], function () use ($router) {
    $router->group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@index')->name('core.sys.user.list');
        Route::get('/{pk}', 'UserController@show')->name('core.sys.user.show');
        Route::post('/', 'UserController@store')->name('core.sys.user.store');
        Route::delete('/{pk}', 'UserController@destroy')->name('core.sys.user.delete');
    });

    $router->group(['prefix' => 'config'], function () {
        Route::get('/', 'ConfigController@index')->name('core.sys.config.list');
        Route::post('/', 'ConfigController@store')->name('core.sys.config.store');
        Route::delete('/{pk}', 'ConfigController@destroy')->name('core.sys.config.delete');
    });

    $router->group(['prefix' => 'type'], function () {
        Route::get('/', 'TypeController@index')->name('core.sys.type.list');
        Route::get('/{pk}', 'TypeController@show')->name('core.sys.type.show');
        Route::post('/', 'TypeController@store')->name('core.sys.type.save');
        Route::delete('/{pk}', 'TypeController@destroy')->name('core.sys.type.delete');
    });
});
