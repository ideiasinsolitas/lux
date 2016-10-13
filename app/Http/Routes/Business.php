<?php

$router->group(['prefix' => 'project', 'namespace' => 'Business', 'middleware' => '\App\Http\Middleware\ServiceLoader'], function () use ($router) {
    Route::get('/', 'ProjectController@index')->name('business.project.list');
    Route::get('/{pk}', 'ProjectController@show')->name('business.project.show');
    Route::post('/', 'ProjectController@store')->name('business.project.save');
});

$router->group(['prefix' => 'order', 'namespace' => 'Business'], function () use ($router) {
    Route::get('/', 'OrderController@index')->name('business.order.list');
    Route::get('/{pk}', 'OrderController@show')->name('business.order.show');
    Route::post('/', 'OrderController@store')->name('business.order.save');
});

$router->group(['prefix' => 'shop', 'namespace' => 'Business'], function () use ($router) {
    Route::get('/', 'ShopController@index')->name('business.shop.list');
    Route::get('/{pk}', 'ShopController@show')->name('business.shop.show');
    Route::post('/', 'ShopController@store')->name('business.shop.save');
});
