<?php

require(__DIR__ . "/Routes/Auth.php");

$router->group(['namespace' => 'Core', 'prefix' => 'api'], function () use ($router) {
    require(__DIR__ . "/Routes/Core/Interaction.php");
    require(__DIR__ . "/Routes/Core/SiteBuilding.php");
    require(__DIR__ . "/Routes/Core/Sys.php");
    require(__DIR__ . "/Routes/Core/Taxonomy.php");
});

$router->group(['namespace' => 'Business', 'prefix' => 'api'], function () use ($router) {
    require(__DIR__ . "/Routes/Business/Logistics.php");
});
