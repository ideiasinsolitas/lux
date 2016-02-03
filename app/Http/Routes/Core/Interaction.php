<?php

$router->group(['namespace' => 'Core', 'prefix' => 'admin', 'middleware' => 'auth'], function () use ($router) {
    $router->group(['namespace' => 'Interaction', 'prefix' => 'interaction'], function () use ($router) {
        $router->group(['middleware' => 'access.routeNeedsPermission:view-backend'], function () use ($router) {

            get('', 'InteractionController@admin')->name('core.interaction.admin');

            $router->group(['namespace' => 'Vote', 'prefix' => 'vote'], function () {

                get('/list/all', 'VoteController@index')->name('core.interaction.vote.list.all');
                get('/list/{page?}', 'VoteController@index')->name('core.interaction.vote.list');
                get('/{id}/show', 'VoteController@show')->name('core.interaction.vote.show');
                get('/{id}/edit', 'VoteController@edit')->name('core.interaction.vote.edit');
                get('/create', 'VoteController@create')->name('core.interaction.vote.create');
                post('/store', 'VoteController@store')->name('core.interaction.vote.store');
                post('/{id}/update', 'VoteController@update')->name('core.interaction.vote.update');
                get('/{id}/destroy', 'VoteController@destroy')->name('core.interaction.vote.delete');
                get('/{id}/delete', 'VoteController@delete')->name('core.interaction.vote.delete');
                get('/{id}/restore', 'VoteController@delete')->name('core.interaction.vote.delete');
                post('/delete', 'VoteController@deleteMany')->name('core.interaction.vote.delete.many');
                post('/mark', 'VoteController@mark')->name('core.interaction.vote.mark');
                get('/deleted/{page?}', 'VoteController@deleted')->name('core.interaction.vote.deleted');
                get('/deactivated/{page?}', 'VoteController@deactivated')->name('core.interaction.vote.deactivated');
            });

            $router->group(['namespace' => 'Like', 'prefix' => 'like'], function () {

                get('/list/all', 'LikeController@index')->name('core.interaction.like.list.all');
                get('/list/{page?}', 'LikeController@index')->name('core.interaction.like.list');
                get('/{id}/show', 'LikeController@show')->name('core.interaction.like.show');
                get('/{id}/edit', 'LikeController@edit')->name('core.interaction.like.edit');
                get('/create', 'LikeController@create')->name('core.interaction.like.create');
                post('/store', 'LikeController@store')->name('core.interaction.like.store');
                post('/{id}/update', 'LikeController@update')->name('core.interaction.like.update');
                get('/{id}/destroy', 'LikeController@destroy')->name('core.interaction.like.delete');
                get('/{id}/delete', 'LikeController@delete')->name('core.interaction.like.delete');
                get('/{id}/restore', 'LikeController@delete')->name('core.interaction.like.delete');
                post('/delete', 'LikeController@deleteMany')->name('core.interaction.like.delete.many');
                post('/mark', 'LikeController@mark')->name('core.interaction.like.mark');
                get('/deleted/{page?}', 'LikeController@deleted')->name('core.interaction.like.deleted');
                get('/deactivated/{page?}', 'LikeController@deactivated')->name('core.interaction.like.deactivated');
            });

            $router->group(['namespace' => 'Friendship', 'prefix' => 'friendship'], function () {
                get('/list/all', 'FriendshipController@index')->name('core.interaction.friendship.list.all');
                get('/list/{page?}', 'FriendshipController@index')->name('core.interaction.friendship.list');
                get('/{id}/show', 'FriendshipController@show')->name('core.interaction.friendship.show');
                get('/{id}/edit', 'FriendshipController@edit')->name('core.interaction.friendship.edit');
                get('/create', 'FriendshipController@create')->name('core.interaction.friendship.create');
                post('/store', 'FriendshipController@store')->name('core.interaction.friendship.store');
                post('/{id}/update', 'FriendshipController@update')->name('core.interaction.friendship.update');
                get('/{id}/destroy', 'FriendshipController@destroy')->name('core.interaction.friendship.delete');
                get('/{id}/delete', 'FriendshipController@delete')->name('core.interaction.friendship.delete');
                get('/{id}/restore', 'FriendshipController@delete')->name('core.interaction.friendship.delete');
                post('/delete', 'FriendshipController@deleteMany')->name('core.interaction.friendship.delete.many');
                post('/mark', 'FriendshipController@mark')->name('core.interaction.friendship.mark');
                get('/deleted/{page?}', 'FriendshipController@deleted')->name('core.interaction.friendship.deleted');
                get('/deactivated/{page?}', 'FriendshipController@deactivated')->name('core.interaction.friendship.deactivated');
            });

            $router->group(['namespace' => 'Folksonomy', 'prefix' => 'folksonomy'], function () {
                get('/list/all', 'FolksonomyController@index')->name('core.interaction.folksonomy.list.all');
                get('/list/{page?}', 'FolksonomyController@index')->name('core.interaction.folksonomy.list');
                get('/{id}/show', 'FolksonomyController@show')->name('core.interaction.folksonomy.show');
                get('/{id}/edit', 'FolksonomyController@edit')->name('core.interaction.folksonomy.edit');
                get('/create', 'FolksonomyController@create')->name('core.interaction.folksonomy.create');
                post('/store', 'FolksonomyController@store')->name('core.interaction.folksonomy.store');
                post('/{id}/update', 'FolksonomyController@update')->name('core.interaction.folksonomy.update');
                get('/{id}/destroy', 'FolksonomyController@destroy')->name('core.interaction.folksonomy.delete');
                get('/{id}/delete', 'FolksonomyController@delete')->name('core.interaction.folksonomy.delete');
                get('/{id}/restore', 'FolksonomyController@delete')->name('core.interaction.folksonomy.delete');
                post('/delete', 'FolksonomyController@deleteMany')->name('core.interaction.folksonomy.delete.many');
                post('/mark', 'FolksonomyController@mark')->name('core.interaction.folksonomy.mark');
                get('/deleted/{page?}', 'FolksonomyController@deleted')->name('core.interaction.folksonomy.deleted');
                get('/deactivated/{page?}', 'FolksonomyController@deactivated')->name('core.interaction.folksonomy.deactivated');
            });

            $router->group(['namespace' => 'Comment', 'prefix' => 'comment'], function () {
                get('/list/all', 'CommentController@index')->name('core.interaction.comment.list.all');
                get('/list/{page?}', 'CommentController@index')->name('core.interaction.comment.list');
                get('/{id}/show', 'CommentController@show')->name('core.interaction.comment.show');
                get('/{id}/edit', 'CommentController@edit')->name('core.interaction.comment.edit');
                get('/create', 'CommentController@create')->name('core.interaction.comment.create');
                post('/store', 'CommentController@store')->name('core.interaction.comment.store');
                post('/{id}/update', 'CommentController@update')->name('core.interaction.comment.update');
                get('/{id}/destroy', 'CommentController@destroy')->name('core.interaction.comment.delete');
                get('/{id}/delete', 'CommentController@delete')->name('core.interaction.comment.delete');
                get('/{id}/restore', 'CommentController@delete')->name('core.interaction.comment.delete');
                post('/delete', 'CommentController@deleteMany')->name('core.interaction.comment.delete.many');
                post('/mark', 'CommentController@mark')->name('core.interaction.comment.mark');
                get('/deleted/{page?}', 'CommentController@deleted')->name('core.interaction.comment.deleted');
                get('/deactivated/{page?}', 'CommentController@deactivated')->name('core.interaction.comment.deactivated');
            });

        });
    });
});
