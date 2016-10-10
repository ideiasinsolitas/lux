<?php

Route::get('/', function () {
    return view('app');
});

Route::get('/upload', function () {
    return view('upload');
});

Route::get('/user', function () {
    return view('user');
});

Route::get('/calendar', function () {
    return view('calendar');
});

Route::get('/estate', function () {
    return view('estate');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/magazine', function () {
    return view('magazine');
});

Route::get('/publisher', function () {
    return view('publisher');
});

Route::get('/project', function () {
    return view('project');
});

Route::get('/order', function () {
    return view('order');
});

Route::get('/shop', function () {
    return view('shop');
});

$router->group(['prefix' => 'api'], function () use ($router) {
    require(__DIR__ . "/Routes/Auth.php");
    require(__DIR__ . "/Routes/Business.php");
    require(__DIR__ . "/Routes/Core.php");
    require(__DIR__ . "/Routes/Ecommerce.php");
    require(__DIR__ . "/Routes/Intel.php");
    require(__DIR__ . "/Routes/Media.php");
    require(__DIR__ . "/Routes/Place.php");
    require(__DIR__ . "/Routes/Publishing.php");
});
