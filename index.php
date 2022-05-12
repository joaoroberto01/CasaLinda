<?php
	require_once 'autoload.php';
	require_once CLASSES_PATH . 'Route.php';

	//print_r($_SERVER);

	Route::add('/', function() {
		require_once VIEWS_PATH . "main.php";
	});

	Route::add('/login', function() {
		require_once VIEWS_PATH . "login.php";
	});

	Route::dispatch();
?>

