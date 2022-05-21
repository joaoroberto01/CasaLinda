<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=PROJECT_NAME?> - Login</title>

	<link rel="stylesheet" href="<?=BS_CSS_PATH?>">
	<link rel="stylesheet" href="<?=VARIABLES_CSS_PATH?>">
	<link rel="stylesheet" type="text/css" href="<?=DEFAULT_CSS_PATH?>">

	<style type="text/css">
		img {
			margin-bottom: 10%;
			width: 90%;
			max-width: 400px;
		}

		form {
			padding: 0 10%;
		}

		button {
			font-weight: bold !important;
		}
		
		#login-container {
			max-width: 400px;
			margin-top: 8%;
		}

		.btn-login {
			color: white !important;
			width: 100%;
		}

		.btn-login:hover {
			background-color: var(--btn-hover-color) !important;
		}
	</style>


</head>
<body>
	<div class="container-fluid">
		<div class="row d-flex justify-content-center">
			<div id="login-container" class="col-sm-3 col-md-6 col-lg-4 text-center">
				<img src="<?=IMG_PATH?>/logo.svg">
				<form class="text-center mt-4" method="POST">
					<input class="form-control no-border" type="text" name="username" placeholder="Usuário">
					<input class="form-control no-border mt-3" type="password" name="password" placeholder="Senha"
					style="margin-bottom: 8%">
					<button class="btn btn-login default-background-color mt-4">Entrar</button><br>
					<a class="default-text-color" href="forgot">Esqueci minha senha</a>
				</form>
			</div>
		</div>
	</div>



<?php
	print_r($_POST);




?>

</body>
</html>