<?php

	function getGreeting(){	
		$hour = date('H');

		if ($hour > 17 || $hour < 4)
			return "Boa Noite";

		if($hour > 11)
			return "Boa Tarde";
		
		return "Bom dia";
	}


?>