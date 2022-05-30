<?php

class Route {
	private static $routes = [];

	public static function add($route, $callback, $authRequired = true){
		$route = trim($route, '/');

		self::$routes[$route] = ['callback' => $callback, 'auth' => $authRequired];
	}

	public static function dispatch(){
		$uri = self::getUri();

		$params = [];
		$authRequired = false;

		$callback = null;
		foreach (self::$routes as $key => $value) {
			if (preg_match("%^{$key}$%", $uri, $params)) {
				$callback = $value['callback'];
				$authRequired = $value['auth'];
				$currentRoute = $key;

				unset($params[0]);

				break;
			}
		}

		if($authRequired){
			$user = json_decode($_COOKIE['user'], true);
			if(!$user)
				header("Location: login");
			array_push($params, $user);
		}
		
		if (!$callback || !is_callable($callback)) {
			View::error("route $uri");
			return;
		}

		call_user_func($callback, ...$params);
	}

	private static function getUri(){
		$uri = str_replace(ROOT_PATH, "", $_SERVER['REQUEST_URI']);
		$uri = trim($uri, '/');

		return $uri;
	}
};

?>