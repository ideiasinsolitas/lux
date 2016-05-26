<?php

Route::get('/login', 'AuthController@form')->name('core.sys.auth.form');
Route::post('/login', 'AuthController@login')->name('core.sys.auth.login');
Route::post('/register', 'AuthController@register')->name('core.sys.auth.register');

Route::get('/password/forgot', 'AuthController@forgotPasswordForm')->name('core.sys.auth.forgot');
Route::get('/password/reset', 'AuthController@resetForm')->name('core.sys.auth.reset');
Route::post('/password/reset', 'AuthController@resetPassword')->name('core.sys.auth.form');
