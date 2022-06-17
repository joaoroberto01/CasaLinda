<?php
require_once CONTROLLERS_PATH . "DBController.php";

class ProductController extends DBController {
	public function __construct(){
		parent::__construct('Products');
	}

	public function create($product){
		$product['category'] = implode(", ", $product['category']);

		$amount = $product['amount'];
		unset($product['amount']);

		$id = parent::insert($product);

		if ($id == 0)
			return false;

		if($amount != 0){
			$movement = ['amount' => $amount, 'price' => $product['price_in'], 'id_product' => $id, 'type' => 'Entrada'];

			$movementsController = new MovementsController();
			$movementsController->create($movement);
		}

		return true;
	}

	public function remove($id){
		parent::delete("WHERE id = ?", [$id]);
	}

	public function edit($id, $product){
		$product['category'] = implode(",", $product['category']);

		return parent::update($product, "WHERE id = ?", [$id]);
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

	public function getAllFiltered($filters = [], $search = ""){
		$baseQuery = "SELECT * FROM Products as P INNER JOIN ProductAmount as PA ON (P.id = PA.id_product) WHERE name LIKE ?";

		$baseParams = ["%$search%"];

		if(count($filters) == 0)
			return parent::rawSelect($baseQuery, $baseParams);


		$results = [];
		foreach($filters as $filter){
			$query = $baseQuery . " AND (SELECT FIND_IN_SET(?, category)) != 0";
			
			$params = $baseParams;
			array_push($params, $filter);

			$results = array_merge(parent::rawSelect($query, $params), $results);
		}


		return $results;
	}

	public function getRestockNeeded(){
		return parent::rawSelect("SELECT * FROM Products as P INNER JOIN ProductAmount as PA ON (P.id = PA.id_product) WHERE amount <= ?", [RESTOCK_LIMIT]);
	}

	public function getProductsCount(){
		return parent::selectSingle("COUNT(id) as count")['count'];
	}

}
?>