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
	if ($_FILES AND $_FILES['image']['size'] > 0) {
		if(!file_exists(PRODUCT_IMAGES_PATH))
			mkdir(PRODUCT_IMAGES_PATH);

		$extension = explode(".", $_FILES['image']['name'])[1];

		$filename = strtolower(utf8_decode(trim($_POST['name'])));
		$filename = str_replace(" ", "_", $filename);

		if(!file_exists(PRODUCT_IMAGES_PATH . $filename))
			mkdir(PRODUCT_IMAGES_PATH . $filename);

		$filename .= "/" . date("Ymd_Hi") . ".$extension";

		if(move_uploaded_file($_FILES['image']['tmp_name'], PRODUCT_IMAGES_PATH . $filename))
			$_POST['image'] = $filename;
	}
	
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
	if ($_FILES) {
		$extension = explode(".", $_FILES['image']['name'])[1];

		$filename = strtolower(utf8_decode(trim($_POST['name'])));
		$filename = str_replace(" ", "_", $filename);

		if(!file_exists(PRODUCT_IMAGES_PATH . $filename))
			mkdir(PRODUCT_IMAGES_PATH . $filename);

		$filename .= "/" . date("Ymd_Hi") . ".$extension";

		if(move_uploaded_file($_FILES['image']['tmp_name'], PRODUCT_IMAGES_PATH . $filename))
			$_POST['image'] = $filename;
	}

	if($_POST){
		$productController = new ProductController();
		if(isset($_POST['image'])){
			$oldImg = $productController->get($id)['image'];
			unlink(PRODUCT_IMAGES_PATH . $oldImg);
		}

		$productController->edit($id, $_POST);
	}

	goToRoute("produtos");
});

Route::add('/produtos/remover/([0-9]+)', function($id) {
	$productController = new ProductController();

	$dir = $productController->get($id)["image"];
	$dir = explode("/", $dir)[0];

	deleteDirectory(PRODUCT_IMAGES_PATH . $dir);

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

Route::add('/relatorios/pdf/(.+)', function($data){
	$data = json_decode(base64_decode($data), true);

	generatePDF($data);
}, false);

Route::add('/logout', function() {
	setcookie('user', null, -1);
	goToRoute("login");
});

Route::dispatch();
?>

