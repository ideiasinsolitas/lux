<?php

$router->group(['namespace' => 'Interaction', 'prefix' => 'interaction'], function () use ($router) {
    $router->group(['namespace' => 'Vote', 'prefix' => 'vote'], function () {
        get('/', 'VoteController@index')->name('core.sys.vote.list');
        get('/{pk}', 'VoteController@show')->name('core.sys.vote.show');
        post('/', 'VoteController@save')->name('core.sys.vote.save');
        delete('/{pk}', 'VoteController@destroy')->name('core.sys.vote.delete');
    });

    $router->group(['namespace' => 'Like', 'prefix' => 'like'], function () {
        get('/', 'LikeController@index')->name('core.sys.like.list');
        get('/{pk}', 'LikeController@show')->name('core.sys.like.show');
        post('/', 'LikeController@save')->name('core.sys.like.save');
        delete('/{pk}', 'LikeController@destroy')->name('core.sys.like.delete');
    });

    $router->group(['namespace' => 'Comment', 'prefix' => 'comment'], function () {
        get('/', 'CommentController@index')->name('core.sys.comment.list');
        get('/{pk}', 'CommentController@show')->name('core.sys.comment.show');
        post('/', 'CommentController@save')->name('core.sys.comment.save');
        delete('/{pk}', 'CommentController@destroy')->name('core.sys.comment.delete');
    });
});
