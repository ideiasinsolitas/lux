<?php

use Illuminate\Routing\Route;

$router->group(['namespace' => 'Core', 'prefix' => 'admin', 'middleware' => 'auth'], function () use ($router) {
    $router->group(['namespace' => 'Interaction', 'prefix' => 'interaction', 'middleware' => 'access.routeNeedsPermission:view-backend'], function () use ($router) {

        Route::get('', 'InteractionController@admin')->name('core.interaction.admin');

        $router->group(['namespace' => 'Vote'], function () {

            // REST: index, store, show, destroy
            Route::resource('vote', 'VoteController', ['except' => ['create', 'update', 'edit']]);

            $router->group(['prefix' => 'vote'], function () {
                Route::get('/{id}/restore', 'VoteController@delete')->name('core.interaction.vote.delete');
                Route::post('/delete', 'VoteController@deleteMany')->name('core.interaction.vote.delete.many');
                Route::post('/mark', 'VoteController@mark')->name('core.interaction.vote.mark');
                Route::get('/deleted', 'VoteController@deleted')->name('core.interaction.vote.deleted');
                Route::get('/deactivated', 'VoteController@deactivated')->name('core.interaction.vote.deactivated');
            });
        });
    });
});
