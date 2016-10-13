<?php

$router->group(['namespace' => 'Auth'], function () use ($router) {

    Route::get('/login', 'AuthController@form')->name('core.auth.form');
    Route::post('/login', 'AuthController@login')->name('core.auth.login');
    Route::get('/logout', 'AuthController@logout')->name('core.auth.logout');

    $router->group(['prefix' => 'register'], function () use ($router) {
        Route::post('/', 'AuthController@register')->name('core.auth.register');
        Route::get('/email_sent', 'AuthController@confirmationEmailSent')->name('core.auth.register_email_sent');
        Route::get('/confirm/{token}', 'AuthController@confirm')->name('core.auth.confirm');
    });

    $router->group(['prefix' => 'password'], function () use ($router) {
        Route::get('/forgot', 'AuthController@forgotPasswordForm')->name('core.auth.forgot');
        Route::get('/reset', 'AuthController@resetForm')->name('core.auth.reset');
        Route::get('/reset/{token}', 'AuthController@resetPassword')->name('core.auth.form');
    });
});
