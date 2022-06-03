<?php
require_once CONTROLLERS_PATH . "DBController.php";

class MovementsController extends DBController{
	public function __construct(){
		parent::__construct('Movements');
	}

	public function create($movement){
		parent::insert($movement);
	}

	public function getAll($predicate = "", $params = []){
		$fields = "M.id as id, name, date, amount, price, type";

		return parent::rawSelect("SELECT $fields FROM Movements AS M INNER JOIN Products AS P ON (M.id_product = P.id) $predicate", $params);
	}

	public function getReport($type, $startDate, $endDate){
		$startDate .= " 00:00";
		$endDate .= " 23:59";

		return $this->getAll("WHERE type = ? AND date BETWEEN ? AND ? ORDER BY amount DESC", [$type, 
			$startDate, $endDate]);
	}

	public function getProfit($startDate = "", $endDate = ""){
		$params = [];
		$where = "";
		if (!empty($startDate) AND !empty($endDate)) {
			$startDate .= " 00:00";
			$endDate .= " 23:59";
			$where = "AND date BETWEEN ? AND ?";
			$params = [$startDate, $endDate];
		}

		$entrada = parent::rawSelect("SELECT SUM(price * amount) as entrada FROM Movements WHERE type = 'Entrada' $where", $params)[0]['entrada'];

		$saida = parent::rawSelect("SELECT SUM(price * amount) as saida FROM Movements WHERE type = 'Saída' $where", $params)[0]['saida'];

		return $saida == 0 ? 0 :  $saida - $entrada;
	}

	public function getFirstMovementDate(){
		$results = parent::selectSingle("date", "WHERE type = 'Entrada' ORDER BY date LIMIT 1");
		if($results)
			return $results['date'];

		return date('Y-m-d');
	}
}

?>