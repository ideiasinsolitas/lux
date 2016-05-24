<?php

return [

<<<<<<< HEAD
<<<<<<< HEAD
    /*
=======
	/*
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
=======
    /*
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
	|--------------------------------------------------------------------------
	| View Storage Paths
	|--------------------------------------------------------------------------
	|
	| Most templating systems load templates from disk. Here you may specify
	| an array of paths that should be checked for your views. Of course
	| the usual Laravel view path has already been registered for you.
	|
	*/

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
    'paths' => [
        realpath(base_path('resources/views'))
    ],

    /*
<<<<<<< HEAD
=======
	'paths' => [
		realpath(base_path('resources/views'))
	],

	/*
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
=======
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
	|--------------------------------------------------------------------------
	| Compiled View Path
	|--------------------------------------------------------------------------
	|
	| This option determines where all the compiled Blade templates will be
	| stored for your application. Typically, this is within the storage
	| directory. However, as usual, you are free to change this value.
	|
	*/

<<<<<<< HEAD
<<<<<<< HEAD
    'compiled' => realpath(storage_path().'/framework/views'),
=======
	'compiled' => realpath(storage_path().'/framework/views'),
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
=======
    'compiled' => realpath(storage_path().'/framework/views'),
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
];
