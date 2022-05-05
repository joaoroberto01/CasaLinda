<?php
	require_once 'constants.php';

	function getGreeting(){	
		$hour = date('H');

		if ($hour > 17 || $hour < 4)
			return "Boa Noite";

		if($hour > 11)
			return "Boa Tarde";
		
		return "Bom dia";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=PROJECT_NAME?> - Inicio</title>

	<link rel="stylesheet" type="text/css" href="<?=BS_PATH?>/css/bootstrap.css">
</head>
<body>
	<h2><?= getGreeting() ?></h2>

	<script src="<?=BS_PATH?>/js/bootstrap.js"></script>
</body>
</html>