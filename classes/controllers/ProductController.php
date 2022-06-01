<?php
require_once CONTROLLERS_PATH . "DBController.php";

class ProductController extends DBController {
	public function __construct(){
		parent::__construct('Products');
	}

	public function create($product){
		$dict = ['name' => $product['name'], 'category' => $product['category'], 'description' => $product['description'], 'price' => $product['price']];

		if(isset($product['image']))
			$dict['image'] = $product['image'];

		$id = parent::insert($dict);

		parent::raw("UPDATE ProductAmount SET amount = ? WHERE id_product = ?", [$product['amount'], $id]);
	}

	public function remove($id){
		parent::delete("WHERE id = ?", [$id]);
	}

	public function edit($id, $product){
		$dict = ['name' => $product['name'], 'category' => $product['category'], 'description' => $product['description'], 'price' => $product['price']];

		if(isset($product['image']))
			$dict['image'] = $product['image'];

		parent::update($dict, "WHERE id = ?", [$id]);

		parent::raw("UPDATE ProductAmount SET amount = ? WHERE id_product = ?", [$product['amount'], $id]);
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
		return parent::rawSelect("SELECT COUNT(id) as count FROM Products as P INNER JOIN ProductAmount as PA ON (P.id = PA.id_product) WHERE amount <= 5")[0]['count'];
	}

	public function getProductsSize(){
		return parent::selectSingle("COUNT(id) as count")['count'];
	}

}
?>