<?php
	require_once 'autoload.php';

	Route::add('/', function() {
		View::render('main');
	});

	Route::add('/login', function() {
		View::render('login/login');
	});

	Route::add('/forgot', function() {
		View::render('login/forgot');
	});

	Route::add('/recovery', function() {
		header("Location: forgot");
	});

	Route::add('/recovery/(.+)', function($userInfo) {
		//var_dump($userInfo);
		View::render('login/recovery', ['userInfo' => $userInfo]);
	});

	Route::add('/changepassword/(.+)', function($userInfo) {
		View::render('login/change_password', ['userInfo' => $userInfo]);
	});

	Route::add('/db', function() {
		$db = new DBController('Usuarios');

   		// $lid = $db->insert(['nome' => "joao", 'idade' => 20]);
		// echo "last inserted id was $lid";
		$results = $db->select('*');
		echo "select all: ";
		print_r($results);

		echo "<br><br>";

		//$db->update(['idade' => 33, 'nome' => "ALTERADO BABACA"], "WHERE id = ?", [18]);
		$db->delete("", []);
		
		$results = $db->select('*');
		print_r($results);

		// $results = $db->selectSingle('*', "WHERE idade = ?", [20]);
		// echo "select single: ";
		// print_r($results);

	});

	Route::dispatch();
?>

