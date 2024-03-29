<?php

if(isset($_COOKIE['user']))
	goToRoute();

if ($_POST){
	$userController = new UserController();
	$password = sha1($_POST['password']);
	$user = $userController->auth($_POST['username'], $password);

    if($user){
        setcookie('user', json_encode($user), time() + 24 * 3600);

        goToRoute();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=PROJECT_NAME?> - Login</title>

	<link rel="stylesheet" href="<?=BS_CSS_PATH?>">
	<link rel="stylesheet" type="text/css" href="<?=DEFAULT_CSS_PATH?>">
	<link rel="stylesheet" href="<?=CSS_PATH?>/login.css">

</head>
<body>
	<div class="container-fluid">
	<?php
		if($_POST)
			echo "<div class='alert alert-danger'>Usuário ou senha incorretos!</div>";
	?>
		<div class="row d-flex justify-content-center">
			<div id="login-container" class="col-sm-3 col-md-6 col-lg-4 text-center">
				<img src="<?=IMG_PATH?>/logo.svg">
				<form class="text-center mt-4" method="POST">
					<input class="username-input form-control default-border" type="text" name="username" placeholder="Usuário">
					<input class="password-input form-control default-border mt-3" type="password" name="password" placeholder="Senha"
					style="margin-bottom: 8%">
					<button class="btn btn-login default-background-color mt-4">Entrar</button><br>
					<a class="default-text-color" href="<?=ROOT_PATH?>esqueci">Esqueci minha senha</a>
				</form>
			</div>
		</div>
	</div>
</body>
</html>