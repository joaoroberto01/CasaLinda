<?php
require_once "utils/utils.php";

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=PROJECT_NAME?> - Inicio</title>

	<link rel="stylesheet" href="<?=BS_CSS_PATH?>">
	<link rel="stylesheet" href="<?=DEFAULT_CSS_PATH?>">
	<link rel="stylesheet" href="<?=CSS_PATH?>/main.css">

	<script src="<?=JS_PATH?>/feather.min.js"></script>
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light" style="padding: 2% 0;">
			<div class="container-fluid p-0">
				<a class="navbar-brand" href="#">
					<img src="<?=IMG_PATH?>/logo.svg" width="120">
				</a>

				<?=getGreeting() . ", ${user['name']}!" ?>
				<div class="d-inline-flex align-items-center" style="justify-content: space-between">
					<span id="timer" class="mr-2">10:00</span>
					<a class="btn btn-logout ml-4" href="logout"><i data-feather="log-out"></i> Sair</a>
				</div>
			</div>
		</nav>

		<div class="row v-space">
			<div class="offset-2 col-8 offset-lg-0 mb-5 mb-lg-0 col-lg-4 p-2 d-flex justify-content-center">
				<div class="card" onclick="goTo('produtos')">
					<div class="card-img card-selected d-flex align-items-center justify-content-center">
						<i class="icon" data-feather="package"></i>
					</div>

					<div class="card-body p-4 text-center">
						<h2 class="card-title text-center">Produtos</h2>
						<p class="card-text text-center">Todos os produtos do seu estoque.</p>
						<a href="produtos" class="btn btn-card">Vamos lá</a>
					</div>
				</div>
			</div>

			<div class="offset-2 col-8 offset-lg-0 mb-5 mb-lg-0 col-lg-4 p-2 d-flex justify-content-center">
				<div class="card" onclick="goTo('relatorios')">
					<div class="card-img card-selected d-flex align-items-center justify-content-center">
						<i class="icon" data-feather="file-text"></i>
					</div>

					<div class="card-body p-4 text-center">
						<h2 class="card-title text-center">Relatórios</h2>
						<p class="card-text text-center">Gere relatórios com as datas desejadas.</p>
						<a href="relatorios" class="btn btn-card">Vamos lá</a>
					</div>
				</div>
			</div>

			<div class="offset-2 col-8 offset-lg-0 mb-5 mb-lg-0 col-lg-4 p-2 d-flex justify-content-center">
				<div class="card" onclick="goTo('movimentos')">
					<div class="card-img card-selected d-flex align-items-center justify-content-center">
						<i class="icon" data-feather="repeat"></i>
					</div>

					<div class="card-body p-4 text-center">
						<h2 class="card-title text-center">Movimentos</h2>
						<p class="card-text text-center">Acompanhe e controle a entrada e saída de produtos.</p>
						<a href="movimentos" class="btn btn-card">Vamos lá</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer class="fixed-bottom text-center p-3">
		Casa Linda by Peer © 2022. All Rights Reserved
	</footer>
	
	
	<script>
		feather.replace()
		const INACTIVITY_TIME = <?= INACTIVITY_TIME?>;	
		const ROOT_PATH = '<?= ROOT_PATH?>';
	</script>

	<script src="<?= BS_JS_PATH ?>"></script>
	<script src="<?= JS_PATH ?>/timer.js"></script>

</body>
</html>