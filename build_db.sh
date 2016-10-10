#!/bin/bash

mysql -uroot -proot -e "drop database laravel; create database laravel;";

composer dumpautoload;
php artisan migrate;
php db:seed;
