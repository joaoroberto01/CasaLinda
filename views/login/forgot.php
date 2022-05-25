<?php
	require_once "utils/email_utils.php";
	if($_POST){
		$username = $_POST['username'];

		$userController = new UserController();
		$results = $userController->selectSingle("id, email, name", "WHERE email = ? OR username = ?", [$username, $username]);
		if($results){
			$code = generateCode();
			$results = array_merge($results, ['code' => $code]);

			$json = json_encode($results);
			header('Location: recovery/' . base64_encode($json));
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=PROJECT_NAME?> - Recuperação de Senha</title>

	<link rel="stylesheet" href="<?=BS_CSS_PATH?>">
	<link rel="stylesheet" href="<?=VARIABLES_CSS_PATH?>">
	<link rel="stylesheet" type="text/css" href="<?=DEFAULT_CSS_PATH?>">

	<style type="text/css">
		form {
			padding: 0 10%;
		}

		button {
			font-weight: bold !important;
		}

		#forgot-container {
			max-width: 400px;
			margin-top: 10%;
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
			<?php
				if($_POST)
					echo "<div class='alert alert-danger'>Usuário não encontrado!</div>";
			?>
			<div id="forgot-container" class="col-sm-3 col-md-6 col-lg-4 text-center">
				<h2><b>Recuperação de Senha</b></h2>
				<form class="text-center mt-4" method="POST">
					<input class="form-control no-border" type="text" name="username" placeholder="Usuário ou Email">
					<button class="btn btn-login default-background-color mt-4">Enviar</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>