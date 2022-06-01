<?php
	require_once CONTROLLERS_PATH . "DBController.php";

	class MovementsController extends DBController{
		public function __construct(){
			parent::__construct('Movements');
		}

		public function create($movement){
			parent::insert($movement);
		}

		public function getAll(){
			$fields = "M.id as id, name, date, amount, price, type";

			return parent::rawSelect("SELECT $fields FROM Movements AS M INNER JOIN Products AS P ON (M.id_product = P.id)");
		}

	}

?>