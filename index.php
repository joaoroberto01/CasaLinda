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
	goToRoute("esqueci");
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
	if($_POST){
		$productController = new ProductController();
		$productController->create($_POST);
	}

	goToRoute("produtos");
});

Route::add('/produtos/detalhes/([0-9]+)', function($id) {
	$results = [];
	if(isset($_COOKIE['user'])){
		$productController = new ProductController();
		$results = $productController->get($id);
	}
	
	echo json_encode($results);
}, false);

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
	View::render('reports/reports');
});

Route::add('/movimentos',function() {
	View::render('movements/movements');
});

Route::add('/movimentos/criar',function() {
	if($_POST){
		$_POST['price'] = str_replace(".", "", $_POST['price']);
		$_POST['price'] = str_replace(",", ".", $_POST['price']);
		$_POST['price'] = str_replace(" ", "", $_POST['price']);
		$_POST['price'] = str_replace('R$', "", $_POST['price']);

		$movementsController = new MovementsController();
		$movementsController->create($_POST);
	}

	goToRoute("movimentos");
});

Route::add('/historico',function() {
	View::render('history/history');
});

Route::add('/db', function() {
	$movementsController = new MovementsController();
	$movementsController->create(['amount' => 5,'price'=> 50 , 'id_product' => 6, 'type' => "Entrada"]);


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

