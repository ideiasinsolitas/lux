<?php
$router->group(['namespace' => 'Sys', 'prefix' => 'sys'], function () use ($router) {

        $router->group(['namespace' => 'Config', 'prefix' => 'config'], function () {
            get('/', 'ConfigController@index')->name('core.sys.config.list');
            get('/{pk}', 'ConfigController@show')->name('core.sys.config.show');
            post('/', 'ConfigController@save')->name('core.sys.config.store');
            delete('/{pk}', 'ConfigController@destroy')->name('core.sys.config.delete');
        });

        $router->group(['namespace' => 'Type', 'prefix' => 'type'], function () {
            get('/', 'TypeController@index')->name('core.sys.type.list');
            get('/{pk}', 'TypeController@show')->name('core.sys.type.show');
            post('/', 'TypeController@save')->name('core.sys.type.save');
            delete('/{pk}', 'TypeController@destroy')->name('core.sys.type.delete');
        });
});
