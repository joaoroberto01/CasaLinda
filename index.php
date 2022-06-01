<?php
require_once 'autoload.php';

Route::add('/', function($userInfo) {
	View::render('main/main', ['user' => $userInfo]);
});

Route::add('/login', function() {
	View::render('login/login');
}, false);

Route::add('/esqueci', function() {
	View::render('login/forgot');
}, false);

Route::add('/recuperar', function() {
	header("Location: esqueci");
}, false);

Route::add('/recuperar/(.+)', function($userInfo) {
	View::render('login/recovery', ['userInfo' => $userInfo]);
}, false);

Route::add('/alterar_senha/(.+)', function($userInfo) {
	View::render('login/change_password', ['userInfo' => $userInfo]);
}, false);

Route::add('/produtos', function() {
	View::render('products/products');
});

Route::add('/produtos/criar', function() {
	echo "Creating<br>";

	if($_POST){
		$productController = new ProductController();
		$productController->create($_POST);
	}

	goToRoute("produtos");
});

Route::add('/produtos/detalhes/([0-9]+)', function($id) {

	$productController = new ProductController();
	echo json_encode($productController->get($id));
});

Route::add('/produtos/atualizar/([0-9]+)', function($id) {
	if($_POST){
		$productController = new ProductController();
		$productController->edit($id, $_POST);
	}

	goToRoute("produtos");
});

Route::add('/produtos/remover/([0-9]+)', function($id) {
	$productController = new ProductController();
	$productController->remove($id);

	goToRoute("produtos");
});

Route::add('/relatorios',function() {
	view::render('reports/reports');
});

Route::add('/movimentos',function() {
	view::render('movements/movements');
});

Route::add('/historico',function() {
	view::render('history/history');
});

Route::add('/db', function() {
	$db = new UserController();

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

}, false);

Route::add('/pdf', function(){
	generatePDF();
}, false);

Route::add('/logout', function() {
	setcookie('user', null, -1);
	goToRoute("login");
});

Route::dispatch();
?>

