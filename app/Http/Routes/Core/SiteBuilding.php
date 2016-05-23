<?php

<<<<<<< HEAD
$router->group(['namespace' => 'SiteBuilding', 'prefix' => 'sitebuilding'], function () use ($router) {
    $router->group(['prefix' => 'area'], function () {
        Route::get('/', 'AreaController@index')->name('core.sys.area.list');
        Route::get('/{pk}', 'AreaController@show')->name('core.sys.area.show');
        Route::post('/', 'AreaController@store')->name('core.sys.area.save');
        Route::delete('/{pk}', 'AreaController@destroy')->name('core.sys.area.delete');
    });

    $router->group(['prefix' => 'block'], function () {
        Route::get('/', 'BlockController@index')->name('core.sys.block.list');
        Route::get('/{pk}', 'BlockController@show')->name('core.sys.block.show');
        Route::post('/', 'BlockController@store')->name('core.sys.block.save');
        Route::delete('/{pk}', 'BlockController@destroy')->name('core.sys.block.delete');
    });

    $router->group(['prefix' => 'menu'], function () {
        Route::get('/', 'MenuController@index')->name('core.sys.menu.list');
        Route::get('/{pk}', 'MenuController@show')->name('core.sys.menu.show');
        Route::post('/', 'MenuController@store')->name('core.sys.menu.save');
        Route::delete('/{pk}', 'MenuController@destroy')->name('core.sys.menu.delete');
=======
$router->group(['namespace' => 'Core', 'prefix' => 'admin', 'middleware' => 'auth'], function () use ($router) {
    $router->group(['namespace' => 'SiteBuilding', 'prefix' => 'sitebuilding'], function () use ($router) {
        $router->group(['middleware' => 'access.routeNeedsPermission:view-backend'], function () use ($router) {

            get('', 'SiteBuildingController@admin')->name('core.site_building.admin');


            $router->group(['namespace' => 'Area', 'prefix' => 'area'], function () {

                get('/list/all', 'AreaController@index')->name('core.site_building.area.list.all');
                get('/list/{page?}', 'AreaController@index')->name('core.site_building.area.list');
                get('/{id}/show', 'AreaController@show')->name('core.site_building.area.show');
                get('/{id}/edit', 'AreaController@edit')->name('core.site_building.area.edit');
                get('/create', 'AreaController@create')->name('core.site_building.area.create');
                post('/store', 'AreaController@store')->name('core.site_building.area.store');
                post('/{id}/update', 'AreaController@update')->name('core.site_building.area.update');
                get('/{id}/destroy', 'AreaController@destroy')->name('core.site_building.area.delete');
                get('/{id}/delete', 'AreaController@delete')->name('core.site_building.area.delete');
                get('/{id}/restore', 'AreaController@delete')->name('core.site_building.area.delete');
                post('/delete', 'AreaController@deleteMany')->name('core.site_building.area.delete.many');
                post('/mark', 'AreaController@mark')->name('core.site_building.area.mark');
                get('/deleted/{page?}', 'AreaController@deleted')->name('core.site_building.area.deleted');
                get('/deactivated/{page?}', 'AreaController@deactivated')->name('core.site_building.area.deactivated');
            });

            $router->group(['namespace' => 'Block', 'prefix' => 'block'], function () {

                get('/list/all', 'BlockController@index')->name('core.site_building.block.list.all');
                get('/list/{page?}', 'BlockController@index')->name('core.site_building.block.list');
                get('/{id}/show', 'BlockController@show')->name('core.site_building.block.show');
                get('/{id}/edit', 'BlockController@edit')->name('core.site_building.block.edit');
                get('/create', 'BlockController@create')->name('core.site_building.block.create');
                post('/store', 'BlockController@store')->name('core.site_building.block.store');
                post('/{id}/update', 'BlockController@update')->name('core.site_building.block.update');
                get('/{id}/destroy', 'BlockController@destroy')->name('core.site_building.block.delete');
                get('/{id}/delete', 'BlockController@delete')->name('core.site_building.block.delete');
                get('/{id}/restore', 'BlockController@delete')->name('core.site_building.block.delete');
                post('/delete', 'BlockController@deleteMany')->name('core.site_building.block.delete.many');
                post('/mark', 'BlockController@mark')->name('core.site_building.block.mark');
                get('/deleted/{page?}', 'BlockController@deleted')->name('core.site_building.block.deleted');
                get('/deactivated/{page?}', 'BlockController@deactivated')->name('core.site_building.block.deactivated');
            });

            $router->group(['namespace' => 'Menu', 'prefix' => 'menu'], function () {

                get('/list/all', 'MenuController@index')->name('core.site_building.menu.list.all');
                get('/list/{page?}', 'MenuController@index')->name('core.site_building.menu.list');
                get('/{id}/show', 'MenuController@show')->name('core.site_building.menu.show');
                get('/{id}/edit', 'MenuController@edit')->name('core.site_building.menu.edit');
                get('/create', 'MenuController@create')->name('core.site_building.menu.create');
                post('/store', 'MenuController@store')->name('core.site_building.menu.store');
                post('/{id}/update', 'MenuController@update')->name('core.site_building.menu.update');
                get('/{id}/destroy', 'MenuController@destroy')->name('core.site_building.menu.delete');
                get('/{id}/delete', 'MenuController@delete')->name('core.site_building.menu.delete');
                get('/{id}/restore', 'MenuController@delete')->name('core.site_building.menu.delete');
                post('/delete', 'MenuController@deleteMany')->name('core.site_building.menu.delete.many');
                post('/mark', 'MenuController@mark')->name('core.site_building.menu.mark');
                get('/deleted/{page?}', 'MenuController@deleted')->name('core.site_building.menu.deleted');
                get('/deactivated/{page?}', 'MenuController@deactivated')->name('core.site_building.menu.deactivated');
            });

        });
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
    });
});
