<?php

$router->group(['namespace' => 'Taxonomy', 'prefix' => 'taxonomy'], function () use ($router) {
    $router->group(['namespace' => 'Term', 'prefix' => 'term'], function () {
        get('/', 'TermController@index')->name('core.sys.term.list');
        get('/{pk}', 'TermController@show')->name('core.sys.term.show');
        post('/', 'TermController@save')->name('core.sys.term.store');
        delete('/{pk}', 'TermController@destroy')->name('core.sys.term.delete');
    });
});
