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
		<div class="row">
			<div class="offset-4 col-4 text-center mt-5">
				<img src="<?=IMG_PATH?>/logo.svg">
				<form class="text-center mt-4" style="padding: 0 20%;">
					<input class="form-control" type="text" name="" placeholder="Usuário">
					<input class="form-control mt-3" type="password" name="" placeholder="Senha">
					<button class="btn btn-login mt-4">Entrar</button>
				</form>
			</div>
		</div>
	</div>



</body>
</html>