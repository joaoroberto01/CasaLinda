<?php

function getGreeting(){	
	$hour = date('H');

	if ($hour > 17 || $hour < 4)
		return "Boa Noite";

	if($hour > 11)
		return "Boa Tarde";
	
	return "Bom dia";
}

function getCategories(){
	$categories = ["Cozinha", "Banheiro", "Sala"];
	sort($categories);
	array_push($categories, "Outros");

	return $categories;
}

function goToRoute($route = ""){
	header("Location: " . ROOT_PATH . $route);
}

function deleteDirectory($dir) {
    if (!file_exists($dir))
        return true;

    if (!is_dir($dir))
        return unlink($dir);

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..')
            continue;

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item))
            return false;

    }

    return rmdir($dir);
}
?>