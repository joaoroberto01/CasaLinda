<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=PROJECT_NAME?> - Login</title>

	<link rel="stylesheet" href="<?=BS_CSS_PATH?>">
	<style type="text/css">
		body {
			background-color: #FFE6D2;
			font-family: Montserrat !important;
		}

		img {
			margin-bottom: 10%;
			width: 100%;
			max-width: 400px;
		}

		form {
			padding: 0 10%;
		}

		input, button {
			border-radius: 8px !important;
		}

		button {
			font-weight: bold !important;
		}

		.no-border:focus, .no-border:active, no-border:visited {
			box-shadow: none !important;
            border: #F38723 solid 3px !important;
		}

		#login-container {
			max-width: 400px;
			margin-top: 10%;
		}

		.btn-login {
			background-color: #F38723;
			color: white;
			width: 100%;
		}
	</style>


</head>
<body>
	<div class="container-fluid">
		<div class="row d-flex justify-content-center">
			<div id="login-container" class="col-4 text-center">
				<img src="<?=IMG_PATH?>/logo.svg">
				<form class="text-center mt-4">
					<input class="form-control no-border" type="text" name="" placeholder="Usuário">
					<input class="form-control no-border mt-3" type="password" name="" placeholder="Senha"
					style="margin-bottom: 10%">
					<button class="btn btn-login mt-4">Entrar</button>
				</form>
			</div>
		</div>
	</div>



</body>
</html>