<?php

Route::post('/register', 'AuthController@register')->name('core.sys.auth.register');
Route::get('/register/email_sent', 'AuthController@confirmationEmailSent')->name('core.sys.auth.register_email_sent');
Route::get('/register/confirm/{token}', 'AuthController@confirm')->name('core.sys.auth.confirm');

Route::get('/login', 'AuthController@form')->name('core.sys.auth.form');
Route::post('/login', 'AuthController@login')->name('core.sys.auth.login');
Route::get('/logout', 'AuthController@logout')->name('core.sys.auth.logout');

Route::get('/password/forgot', 'AuthController@forgotPasswordForm')->name('core.sys.auth.forgot');
Route::get('/password/reset', 'AuthController@resetForm')->name('core.sys.auth.reset');
Route::get('/password/email_sent', 'AuthController@resetEmailSent')->name('core.sys.auth.reset_email_sent');
Route::get('/password/reset/{token}', 'AuthController@resetPassword')->name('core.sys.auth.form');
