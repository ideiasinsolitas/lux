<?php

$router->group(['prefix' => 'publishing', 'namespace' => 'Publishing'], function () use ($router) {
    Route::get('/', 'BlogController@index')->name('publishing.blog.list');
    Route::get('/{pk}', 'BlogController@show')->name('publishing.blog.show');
    Route::post('/', 'BlogController@store')->name('publishing.blog.save');
});

$router->group(['prefix' => 'order', 'namespace' => 'Publishing'], function () use ($router) {
    Route::get('/', 'MagazineController@index')->name('publishing.magazine.list');
    Route::get('/{pk}', 'MagazineController@show')->name('publishing.magazine.show');
    Route::post('/', 'MagazineController@store')->name('publishing.magazine.save');
});

$router->group(['prefix' => 'shop', 'namespace' => 'Publishing'], function () use ($router) {
    Route::get('/', 'PublisherController@index')->name('publishing.publisher.list');
    Route::get('/{pk}', 'PublisherController@show')->name('publishing.publisher.show');
    Route::post('/', 'PublisherController@store')->name('publishing.publisher.save');
});
