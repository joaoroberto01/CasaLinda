<?php
require_once CONTROLLERS_PATH . "DBController.php";

class UserController extends DBController {

	public function __construct(){
		parent::__construct('Users');
	}

	public function auth($username, $password){
		$results = parent::selectSingle("id, name", "WHERE username = ? AND password = ?", [$username, $password]);

		return $results;
	}
}


?>