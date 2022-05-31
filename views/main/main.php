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

				<b><?=getGreeting() . ", ${user['name']}!" ?></b>
				<div class="d-inline-flex align-items-center" style="justify-content: space-between">
					<span id="timer" class="mr-2"><?=printf("%d:%d", INACTIVITY_TIME / 60, INACTIVITY_TIME % 60)?></span>
					<a class="btn btn-logout ml-4" href="logout"><i data-feather="log-out"></i> Sair</a>
				</div>
			</div>
		</nav>

		<div class="row v-space">
			<div class="offset-2 col-8 offset-md-0 col-md-6 mb-5 mb-lg-0 col-lg-3 p-2 d-flex justify-content-center">
				<div class="card">
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

			<div class="offset-2 col-8 offset-md-0 col-md-6 mb-5 mb-lg-0 col-lg-3 p-2 d-flex justify-content-center">
				<div class="card">
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

			<div class="offset-2 col-8 offset-md-0 col-md-6 mb-5 mb-lg-0 col-lg-3 p-2 d-flex justify-content-center">
				<div class="card">
					<div class="card-img card-selected d-flex align-items-center justify-content-center">
						<i class="icon" data-feather="repeat"></i>
					</div>

					<div class="card-body p-4 text-center">
						<h2 class="card-title text-center">Movimentos</h2>
						<p class="card-text text-center">Controle a saída ou entrada de produtos.</p>
						<a href="movimentos" class="btn btn-card">Vamos lá</a>
					</div>
				</div>
			</div>

			<div class="offset-2 col-8 offset-md-0 col-md-6 mb-5 mb-lg-0 col-lg-3 p-2 d-flex justify-content-center">
				<div class="card">
					<div class="card-img card-selected d-flex align-items-center justify-content-center">
						<i class="icon" data-feather="clock"></i>
					</div>

					<div class="card-body p-4 text-center">
						<h2 class="card-title text-center">Histórico</h2>
						<p class="card-text text-center">Acompanhe a entrada e saída de produtos.</p>
						<a href="historico" class="btn btn-card">Vamos lá</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer class="fixed-bottom text-center p-3">
		Casa Linda by Peer © 2022. All Rights Reserved
	</footer>
	
	
	<script src="<?=BS_JS_PATH?>"></script>
	<script type="text/javascript">
		const INACTIVITY_TIME = <?= INACTIVITY_TIME?>;	
		const START_TIME = 5;
		var time;
		var startTime;

		function resetTimer(){
			if (startTime == START_TIME)
				return;

			time = INACTIVITY_TIME;
			startTime = START_TIME;
			timer.style.opacity = '0';
		}

		var activityEvents = ['mousedown', 'mousemove', 'keydown', 'scroll', 'touchstart'];

		activityEvents.forEach(function(eventName) {
			document.addEventListener(eventName, resetTimer, true);
		});

		resetTimer();

		setInterval(function(){
			var timer = document.getElementById("timer");

			if(startTime <= 0){
				var m = Math.floor(time / 60);
				var s = time % 60;


				if (m < 10) m = "0" + m;
				if (s < 10) s = "0" + s;

				timer.innerHTML = `${m}:${s}`;
				timer.style.opacity = '1';

				time--;
				if(time == -1){
					window.location = "logout";
				}
			}else{
				startTime--;
				timer.style.opacity = '0';
			}
		}, 1000);
	</script>

	<script>
		feather.replace()
	</script>

</body>
</html>