<?php

$router->group(['namespace' => 'Taxonomy', 'prefix' => 'taxonomy'], function () use ($router) {
    $router->group(['prefix' => 'term'], function () {
        Route::get('/', 'TermController@index')->name('core.sys.term.list');
        Route::get('/{pk}', 'TermController@show')->name('core.sys.term.show');
        Route::post('/', 'TermController@store')->name('core.sys.term.store');
        Route::delete('/{pk}', 'TermController@destroy')->name('core.sys.term.delete');
    });
});
