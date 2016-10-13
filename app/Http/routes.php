<?php

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
require(__DIR__ . "/Routes/Auth.php");

$router->group(['namespace' => 'Core', 'prefix' => 'api'], function () use ($router) {
    require(__DIR__ . "/Routes/Core/Interaction.php");
    require(__DIR__ . "/Routes/Core/SiteBuilding.php");
    require(__DIR__ . "/Routes/Core/Sys.php");
    require(__DIR__ . "/Routes/Core/Taxonomy.php");
=======
=======
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
/**
 * Switch between the included languages
 */
$router->group(['namespace' => 'Language'], function () use ($router) {

    require(__DIR__ . "/Routes/Language/Lang.php");
});

/**
 * Frontend Routes
 * Namespaces indicate folder structure
 */
$router->group(['namespace' => 'Frontend'], function () use ($router) {

    require(__DIR__ . "/Routes/Frontend/Frontend.php");
    require(__DIR__ . "/Routes/Frontend/Access.php");
    require(__DIR__ . "/Routes/Frontend/Blog.php");
    //require(__DIR__ . "/Routes/Frontend/GeoLocation.php");
    //require(__DIR__ . "/Routes/Frontend/People.php");
});

/**
 * Backend Routes
 * Namespaces indicate folder structure
 */
$router->group(['namespace' => 'Backend'], function () use ($router) {

    $router->group(['prefix' => 'admin', 'middleware' => 'auth'], function () use ($router) {
    
        /**
         * These routes need view-backend permission (good if you want to allow more than one group in the backend, then limit the backend features by different roles or permissions)
         *
         * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
         */
        $router->group(['middleware' => 'access.routeNeedsPermission:view-backend'], function () use ($router) {
        
            require(__DIR__ . "/Routes/Backend/Dashboard.php");
            require(__DIR__ . "/Routes/Backend/Access.php");
            require(__DIR__ . "/Routes/Backend/Blog.php");
        });
    });
<<<<<<< HEAD
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
=======
=======
require(__DIR__ . "/Routes/Auth.php");

$router->group(['namespace' => 'Core', 'prefix' => 'api'], function () use ($router) {
    require(__DIR__ . "/Routes/Core/Interaction.php");
    require(__DIR__ . "/Routes/Core/SiteBuilding.php");
    require(__DIR__ . "/Routes/Core/Sys.php");
    require(__DIR__ . "/Routes/Core/Taxonomy.php");
>>>>>>> core-develop
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
=======
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
>>>>>>> develop
});
