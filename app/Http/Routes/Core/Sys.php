<?php

$router->group(['namespace' => 'Core', 'prefix' => 'admin', 'middleware' => 'auth'], function () use ($router) {
    $router->group(['namespace' => 'Sys', 'prefix' => 'sys'], function () use ($router) {
        $router->group(['middleware' => 'access.routeNeedsPermission:view-backend'], function () use ($router) {

            get('', 'SysController@admin')->name('core.sys.admin');


            $router->group(['namespace' => 'Config', 'prefix' => 'config'], function () {

                get('/list/all', 'ConfigController@index')->name('core.sys.config.list.all');
                get('/list/{page?}', 'ConfigController@index')->name('core.sys.config.list');
                get('/{id}/show', 'ConfigController@show')->name('core.sys.config.show');
                get('/{id}/edit', 'ConfigController@edit')->name('core.sys.config.edit');
                get('/create', 'ConfigController@create')->name('core.sys.config.create');
                post('/store', 'ConfigController@store')->name('core.sys.config.store');
                post('/{id}/update', 'ConfigController@update')->name('core.sys.config.update');
                get('/{id}/destroy', 'ConfigController@destroy')->name('core.sys.config.delete');
                get('/{id}/delete', 'ConfigController@delete')->name('core.sys.config.delete');
                get('/{id}/restore', 'ConfigController@delete')->name('core.sys.config.delete');
                post('/delete', 'ConfigController@deleteMany')->name('core.sys.config.delete.many');
                post('/mark', 'ConfigController@mark')->name('core.sys.config.mark');
                get('/deleted/{page?}', 'ConfigController@deleted')->name('core.sys.config.deleted');
                get('/deactivated/{page?}', 'ConfigController@deactivated')->name('core.sys.config.deactivated');
            });

            $router->group(['namespace' => 'Type', 'prefix' => 'type'], function () {

                get('/list/all', 'TypeController@index')->name('core.sys.type.list.all');
                get('/list/{page?}', 'TypeController@index')->name('core.sys.type.list');
                get('/{id}/show', 'TypeController@show')->name('core.sys.type.show');
                get('/{id}/edit', 'TypeController@edit')->name('core.sys.type.edit');
                get('/create', 'TypeController@create')->name('core.sys.type.create');
                post('/store', 'TypeController@store')->name('core.sys.type.store');
                post('/{id}/update', 'TypeController@update')->name('core.sys.type.update');
                get('/{id}/destroy', 'TypeController@destroy')->name('core.sys.type.delete');
                get('/{id}/delete', 'TypeController@delete')->name('core.sys.type.delete');
                get('/{id}/restore', 'TypeController@delete')->name('core.sys.type.delete');
                post('/delete', 'TypeController@deleteMany')->name('core.sys.type.delete.many');
                post('/mark', 'TypeController@mark')->name('core.sys.type.mark');
                get('/deleted/{page?}', 'TypeController@deleted')->name('core.sys.type.deleted');
                get('/deactivated/{page?}', 'TypeController@deactivated')->name('core.sys.type.deactivated');
            });

        });
    });
});
