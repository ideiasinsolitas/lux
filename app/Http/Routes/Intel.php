<?php

$router->group(['prefix' => 'intel', 'namespace' => 'Intel'], function () use ($router) {
    Route::get('/', 'CalendarController@index')->name('intel.calendar.list');
    Route::get('/{pk}', 'CalendarController@show')->name('intel.calendar.show');
    Route::post('/', 'CalendarController@store')->name('intel.calendar.save');
});

$router->group(['prefix' => 'intel', 'namespace' => 'Intel'], function () use ($router) {
    Route::get('/', 'EstateController@index')->name('intel.estate.list');
    Route::get('/{pk}', 'EstateController@show')->name('intel.estate.show');
    Route::post('/', 'EstateController@store')->name('intel.estate.save');
});
