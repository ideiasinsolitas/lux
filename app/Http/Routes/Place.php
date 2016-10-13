<?php

$router->group(['prefix' => 'publishing', 'namespace' => 'Publishing'], function () use ($router) {
    Route::get('/', 'BlogController@index')->name('publishing.blog.list');
    Route::get('/{pk}', 'BlogController@show')->name('publishing.blog.show');
    Route::post('/', 'BlogController@store')->name('publishing.blog.save');
});
