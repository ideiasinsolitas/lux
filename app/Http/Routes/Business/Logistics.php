<?php

$router->group(['namespace' => 'Logistics', 'prefix' => 'logistics'], function () use ($router) {
    $router->group(['prefix' => 'storage'], function () {
        Route::get('/', 'StorageController@index')->name('business.logistics.storage.list');
        Route::get('/{pk}', 'StorageController@show')->name('business.logistics.storage.show');
        Route::post('/', 'StorageController@store')->name('business.logistics.storage.save');
        Route::delete('/{pk}', 'StorageController@destroy')->name('business.logistics.storage.delete');
    });

    $router->group(['prefix' => 'shipping'], function () {
        Route::get('/', 'ShippingController@index')->name('business.logistics.shipping.list');
        Route::get('/{pk}', 'ShippingController@show')->name('business.logistics.shipping.show');
        Route::post('/', 'ShippingController@store')->name('business.logistics.shipping.save');
        Route::delete('/{pk}', 'ShippingController@destroy')->name('business.logistics.shipping.delete');
    });
});
