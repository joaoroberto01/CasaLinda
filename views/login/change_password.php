<?php
	require_once "utils/email_utils.php";
	if(!isset($userInfo))
		header("Location: forgot");

	$userInfo = json_decode(base64_decode($userInfo), true);

	if($_POST){
		$email = $userInfo['email'];

		$password = sha1($_POST['password']);

		$userController = new UserController();
		
		$userController->update(['password' => $password], "WHERE id = ?", [$userInfo['id']]);
		$updated = true;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=PROJECT_NAME?> - Alterar Senha</title>

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
				if($_POST){
					if ($updated)
						echo "<div class='alert alert-success'>Senha alterada com sucesso!</div>";	
					else
						echo "<div class='alert alert-danger'>Falha ao alterar senha: Senha incorreta!</div>";	
					
				}
			?>
			<div id="forgot-container" class="col-sm-3 col-md-6 col-lg-4 text-center">
				<h2><b>Alterar Senha</b></h2>
				<form class="text-center mt-4" method="POST">
					<input class="form-control no-border" type="password" name="password" placeholder="Nova Senha">
					<input class="form-control no-border mt-3" type="password" placeholder="Confirmar nova senha">
					<button class="btn btn-login default-background-color mt-4">Alterar</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>