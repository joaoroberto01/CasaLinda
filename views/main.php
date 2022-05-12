<?php
	$autenticada = false;
	if(!$autenticada){
		header("Location: login/");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=PROJECT_NAME?> - Inicio</title>

	<link rel="stylesheet" href="<?=BS_CSS_PATH?>">
</head>
<body>
	<h2><?= getGreeting() ?></h2>

	<script src="<?=BS_JS_PATH?>"></script>
</body>
</html>