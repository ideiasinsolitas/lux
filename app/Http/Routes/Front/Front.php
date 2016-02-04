<?php

/**
 * Frontend Controllers
 */
get('/', 'FrontendController@index')->name('home');
get('macros', 'FrontendController@macros');

/**
 * These frontend controllers require the user to be logged in
 */
$router->group(['middleware' => 'auth'], function () {

    get('dashboard', 'DashboardController@index')->name('front.dashboard');
    get('profile/edit', 'ProfileController@edit')->name('front.profile.edit');
    patch('profile/update', 'ProfileController@update')->name('front.profile.update');
});
