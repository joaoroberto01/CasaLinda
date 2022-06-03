<?php
	require_once "utils/email_utils.php";

	if (!isset($userInfo) || !$userInfo)
		header("Location: forgot");

	$userInfo = json_decode(base64_decode($userInfo), true);

	$code = isset($userInfo['code']) ? $userInfo['code'] : "";
	if($_POST){
		if($_POST['code'] == $code){
			$json = json_encode($userInfo);
			header("Location: " . ROOT_PATH . "alterar_senha/" . base64_encode($json));
		}
	}else{
		if($code)
			sendRecoveryEmail($userInfo['email'], $userInfo['name'], $code);
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
	<link rel="stylesheet" href="<?=CSS_PATH?>/recovery.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row d-flex justify-content-center">
			<?php
				if($_POST)
					echo "<div class='alert alert-danger'>Código incorreto!</div>";
			?>
			<div id="forgot-container" class="col-sm-3 col-md-6 col-lg-4 text-center">
				<h2><b>Insira o código</b></h2>
				<p>Um código para recuperação foi enviado para o email <?=hideEmail($userInfo['email'])?>. Siga as instruções necessárias.</p>
				<form class="text-center mt-4" method="POST">
					<input class="form-control no-border" type="text" name="code" placeholder="Código">
					<button class="btn btn-login default-background-color mt-4">Enviar</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>