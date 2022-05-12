<?php
	require_once 'autoload.php';
	require_once CLASSES_PATH . 'Route.php';
	require_once CLASSES_PATH . 'View.php';

	//print_r($_SERVER);

	Route::add('/', function() {
		View::render('main');
	});

	Route::add('/login', function() {
		View::render('login');
	});

	Route::dispatch();
?>

