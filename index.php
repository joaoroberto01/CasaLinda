<?php
	require_once 'autoload.php';
	require_once CLASSES_PATH . 'Route.php';
	require_once CLASSES_PATH . 'View.php';

	require_once CLASSES_PATH . 'DB.php';

	Route::add('/', function() {
		View::render('main');
	});

	Route::add('/login', function() {
		View::render('login');
	});

	// Route::add('/db', function() {
	// 	$db = new DB("estoque");
	// 	//select table_schema as database_name, table_name from information_schema.tables
	// 	//$db->select("table_schema as database_name", ["clause" => "", "values" => []])

	// 	//$results = $db->select("*", ['clause' => "id_produto = ? OR id_produto = ?", "values" => [1, 0]]);

	// 	$results = $db->selectAll("*");

	// 	var_dump($results);
	// });

	Route::dispatch();
?>

