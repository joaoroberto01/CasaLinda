<?php

function getGreeting(){	
	$hour = date('H');

	if ($hour > 17 || $hour < 4)
		return "Boa Noite";

	if($hour > 11)
		return "Boa Tarde";
	
	return "Bom dia";
}

function goToRoute($route = ""){
	header("Location: " . ROOT_PATH . $route);
}

function formatDate($date, $format = "d/m/Y H:i:s"){
	$date = date_create($date);
	return date_format($date, $format);
}

function formatCurrency($value){
	return 'R$' . number_format($value, 2, ",", ".");
}
?>