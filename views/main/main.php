<?php
$user = json_decode($_COOKIE['user'], true);
if(!$user)
	header("Location: login");

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

	<style type="text/css">
		.btn-logout {
			background-color: var(--logout-background-color) !important;
			color: white !important;
		}

		.btn-logout:hover {
			background-color: var(--logout-hover-background-color) !important;
		}

		#timer {
			color: var(--light-black);
			font-family: SF-Bold;
			margin-right: 2vw;
		}
	</style>

</head>
<body>
	<!-- <h2>//getGreeting()</h2> -->


	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light" style="padding: 2% 0;">
			<div class="container-fluid p-0">
				<a class="navbar-brand" href="#">
					<img src="<?=IMG_PATH?>/logo.svg" style="background: transparent;" alt="" width="120">
				</a>
				<div class="d-inline-flex align-items-center" style="justify-content: space-between">
					<span id="timer" class="mr-2"></span>
					<button class="btn btn-logout ml-4">Sair</button>
				</div>
			</div>
		</nav>

		<div class="row">
			<div class="col-3 p-2">
				<div class="card">
					<img src="http://www.sitiovojoao.com.br/wp-content/uploads/2020/11/ketchup-752x440_Easy-Resize.com_-1200x675.jpg" alt="...">
					<div class="card-body text-center">
						<h5 class="card-title text-center">Card title</h5>
						<p class="card-text text-center">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
						<a href="#" class="btn btn-primary">Go somewhere</a>
					</div>
				</div>
			</div>

			<div class="col-3 p-2">
				<div class="card">
					<img src="http://www.sitiovojoao.com.br/wp-content/uploads/2020/11/ketchup-752x440_Easy-Resize.com_-1200x675.jpg" alt="...">
					<div class="card-body text-center">
						<h5 class="card-title text-center">Card title</h5>
						<p class="card-text text-center">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
						<a href="#" class="btn btn-primary">Go somewhere</a>
					</div>
				</div>
			</div>

			<div class="col-3 p-2">
				<div class="card">
					<img src="http://www.sitiovojoao.com.br/wp-content/uploads/2020/11/ketchup-752x440_Easy-Resize.com_-1200x675.jpg" alt="...">
					<div class="card-body text-center">
						<h5 class="card-title text-center">Card title</h5>
						<p class="card-text text-center">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
						<a href="#" class="btn btn-primary">Go somewhere</a>
					</div>
				</div>
			</div>

			<div class="col-3 p-2">
				<div class="card">
					<img src="http://www.sitiovojoao.com.br/wp-content/uploads/2020/11/ketchup-752x440_Easy-Resize.com_-1200x675.jpg" alt="...">
					<div class="card-body text-center">
						<h5 class="card-title text-center">Card title</h5>
						<p class="card-text text-center">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
						<a href="#" class="btn btn-primary">Go somewhere</a>
					</div>
				</div>
			</div>
		</div>
	</div>

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
			timer.style.display = 'none';
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
				timer.style.display = 'block';

				time--;
			}else{
				startTime--;
				timer.style.display = 'none';
			}
		}, 1000);
	</script>
</body>
</html>