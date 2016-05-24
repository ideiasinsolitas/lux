<?php

$router->group(['namespace' => 'Interaction', 'prefix' => 'interaction'], function () use ($router) {

    $router->group(['prefix' => 'comment'], function () {
        Route::get('/', 'CommentController@index')->name('core.sys.comment.list');
        Route::get('/{pk}', 'CommentController@show')->name('core.sys.comment.show');
        Route::post('/', 'CommentController@store')->name('core.sys.comment.save');
        Route::delete('/{pk}', 'CommentController@destroy')->name('core.sys.comment.delete');
    });
});
