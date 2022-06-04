<?php
    function formatDate($date, $format = "d/m/Y H:i:s"){
        $date = date_create($date);
        return date_format($date, $format);
    }
    
    function formatCurrency($value){
        return 'R$' . number_format($value, 2, ",", ".");
    }

    function clearCurrency($currency){
        $currency = str_replace(".", "", $currency);
		$currency = str_replace(",", ".", $currency);
		$currency = str_replace(" ", "", $currency);
		$currency = str_replace('R$', "", $currency);

        return $currency;
    }
?>