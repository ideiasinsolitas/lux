<?php

$router->group(['namespace' => 'Interaction', 'prefix' => 'interaction'], function () use ($router) {
    $router->group(['namespace' => 'Vote', 'prefix' => 'vote'], function () {
        Route::get('/', 'VoteController@index')->name('core.sys.vote.list');
        Route::get('/{pk}', 'VoteController@show')->name('core.sys.vote.show');
        Route::post('/', 'VoteController@store')->name('core.sys.vote.save');
        Route::delete('/{pk}', 'VoteController@destroy')->name('core.sys.vote.delete');
    });

    $router->group(['namespace' => 'Like', 'prefix' => 'like'], function () {
        Route::get('/', 'LikeController@index')->name('core.sys.like.list');
        Route::get('/{pk}', 'LikeController@show')->name('core.sys.like.show');
        Route::post('/', 'LikeController@store')->name('core.sys.like.save');
        Route::delete('/{pk}', 'LikeController@destroy')->name('core.sys.like.delete');
    });

    $router->group(['namespace' => 'Comment', 'prefix' => 'comment'], function () {
        Route::get('/', 'CommentController@index')->name('core.sys.comment.list');
        Route::get('/{pk}', 'CommentController@show')->name('core.sys.comment.show');
        Route::post('/', 'CommentController@store')->name('core.sys.comment.save');
        Route::delete('/{pk}', 'CommentController@destroy')->name('core.sys.comment.delete');
    });
});
