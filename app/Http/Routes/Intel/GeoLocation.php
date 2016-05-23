<?php

$router->group(['namespace' => 'Package1', 'prefix' => 'package1'], function () use ($router) {
                
    $router->group(['namespace' => 'Package1', 'prefix' => 'package2'], function () {
        get('', 'NameController@site')->name('package.name');
    });

    $router->group(['prefix' => 'admin', 'middleware' => 'auth'], function () use ($router) {
        $router->group(['middleware' => 'access.routeNeedsPermission:view-backend'], function () use ($router) {
            $router->group(['middleware' => 'auth', 'namespace' => 'Name', 'prefix' => 'name'], function () {

                get('', 'NameController@admin')->name('package.name');

                get('/list/all', 'NameController@index')->name('package.name.list.all');
                get('/list/{page?}', 'NameController@index')->name('package.name.list');
                get('/{id}/show', 'NameController@show')->name('package.name.show');
                get('/{id}/edit', 'NameController@edit')->name('package.name.edit');
                get('/create', 'NameController@create')->name('package.name.create');
                post('/store', 'NameController@store')->name('package.name.store');
                post('/{id}/update', 'NameController@update')->name('package.name.update');
                get('/{id}/destroy', 'NameController@destroy')->name('package.name.delete');
                get('/{id}/delete', 'NameController@delete')->name('package.name.delete');
                get('/{id}/restore', 'NameController@delete')->name('package.name.delete');
                post('/delete', 'NameController@deleteMany')->name('package.name.delete_many');
                post('/mark', 'NameController@mark')->name('package.name.mark');
                get('/deleted/{page?}', 'NameController@')->name('package.name.');
                get('/deactivated/{page?}', 'NameController@')->name('package.name.');

            });
        });
    });
});
