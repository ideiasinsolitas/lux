<?php
$router->group(['namespace' => 'Sys', 'prefix' => 'sys'], function () use ($router) {

        $router->group(['namespace' => 'Config', 'prefix' => 'config'], function () {
            Route::get('/', 'ConfigController@index')->name('core.sys.config.list');
            Route::get('/{pk}', 'ConfigController@show')->name('core.sys.config.show');
            Route::post('/', 'ConfigController@store')->name('core.sys.config.store');
            Route::delete('/{pk}', 'ConfigController@destroy')->name('core.sys.config.delete');
        });

        $router->group(['namespace' => 'Type', 'prefix' => 'type'], function () {
            Route::get('/', 'TypeController@index')->name('core.sys.type.list');
            Route::get('/{pk}', 'TypeController@show')->name('core.sys.type.show');
            Route::post('/', 'TypeController@store')->name('core.sys.type.save');
            Route::delete('/{pk}', 'TypeController@destroy')->name('core.sys.type.delete');
        });
});
