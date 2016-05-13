<?php

$router->group(['namespace' => 'SiteBuilding', 'prefix' => 'sitebuilding'], function () use ($router) {
    $router->group(['namespace' => 'Area', 'prefix' => 'area'], function () {
        get('/', 'AreaController@index')->name('core.sys.area.list');
        get('/{pk}', 'AreaController@show')->name('core.sys.area.show');
        post('/', 'AreaController@save')->name('core.sys.area.save');
        delete('/{pk}', 'AreaController@destroy')->name('core.sys.area.delete');
    });

    $router->group(['namespace' => 'Block', 'prefix' => 'block'], function () {
        get('/', 'BlockController@index')->name('core.sys.block.list');
        get('/{pk}', 'BlockController@show')->name('core.sys.block.show');
        post('/', 'BlockController@save')->name('core.sys.block.save');
        delete('/{pk}', 'BlockController@destroy')->name('core.sys.block.delete');
    });

    $router->group(['namespace' => 'Menu', 'prefix' => 'menu'], function () {
        get('/', 'MenuController@index')->name('core.sys.menu.list');
        get('/{pk}', 'MenuController@show')->name('core.sys.menu.show');
        post('/', 'MenuController@save')->name('core.sys.menu.save');
        delete('/{pk}', 'MenuController@destroy')->name('core.sys.menu.delete');
    });
});
