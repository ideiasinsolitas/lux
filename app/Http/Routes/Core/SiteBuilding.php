<?php

$router->group(['namespace' => 'SiteBuilding', 'prefix' => 'sitebuilding'], function () use ($router) {
    $router->group(['namespace' => 'Area', 'prefix' => 'area'], function () {
        Route::get('/', 'AreaController@index')->name('core.sys.area.list');
        Route::get('/{pk}', 'AreaController@show')->name('core.sys.area.show');
        Route::post('/', 'AreaController@store')->name('core.sys.area.save');
        Route::delete('/{pk}', 'AreaController@destroy')->name('core.sys.area.delete');
    });

    $router->group(['namespace' => 'Block', 'prefix' => 'block'], function () {
        Route::get('/', 'BlockController@index')->name('core.sys.block.list');
        Route::get('/{pk}', 'BlockController@show')->name('core.sys.block.show');
        Route::post('/', 'BlockController@store')->name('core.sys.block.save');
        Route::delete('/{pk}', 'BlockController@destroy')->name('core.sys.block.delete');
    });

    $router->group(['namespace' => 'Menu', 'prefix' => 'menu'], function () {
        Route::get('/', 'MenuController@index')->name('core.sys.menu.list');
        Route::get('/{pk}', 'MenuController@show')->name('core.sys.menu.show');
        Route::post('/', 'MenuController@store')->name('core.sys.menu.save');
        Route::delete('/{pk}', 'MenuController@destroy')->name('core.sys.menu.delete');
    });
});
