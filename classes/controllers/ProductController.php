<?php
require_once CONTROLLERS_PATH . "DBController.php";

class ProductController extends DBController {
	public function __construct(){
		parent::__construct('Products');
	}

	public function create($product){
		$id = parent::insert($product);

		parent::raw("UPDATE ProductAmount SET amount = ? WHERE id_product = ?", [$amount, $id]);
	}

	public function remove($id){
		parent::delete("WHERE id = ?", [$id]);
	}

	public function edit($id, $product){
		parent::update($product, "WHERE id = ?", [$id]);
	}

	public function get($id){
		return parent::rawSelect("SELECT * FROM Products as P INNER JOIN ProductAmount as PA ON (P.id = PA.id_product) WHERE id = ?", [$id])[0];
	}

	public function getAll($filter = "", $params = []){
		$query = "SELECT * FROM Products as P INNER JOIN ProductAmount as PA ON (P.id = PA.id_product)";
		if ($filter)
			$query .= " $filter";

		return parent::rawSelect($query, $params);
	}

	public function getRestockNeeded(){
		return parent::rawSelect("SELECT * FROM Products as P INNER JOIN ProductAmount as PA ON (P.id = PA.id_product) WHERE amount <= ?", [RESTOCK_LIMIT]);
	}

	public function getBalance(){
		$entrada = parent::rawSelect("SELECT SUM(price * amount) as entrada FROM Movements WHERE type = 'Entrada'", [])[0]['entrada'];

		return $saida == 0 ? 0 : abs($entrada - $saida);
	}

	public function getProfit(){
		$entrada = parent::rawSelect("SELECT SUM(price * amount) as entrada FROM Movements WHERE type = 'Entrada'", [])[0]['entrada'];

		$saida = parent::rawSelect("SELECT SUM(price * amount) as saida FROM Movements WHERE type = 'Saída'", [])[0]['saida'];

		return $saida == 0 ? 0 :  $saida - $entrada;
	}

	public function getProductsCount(){
		return parent::selectSingle("COUNT(id) as count")['count'];
	}

}
?>