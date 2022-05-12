<?php

class Route {
	private static $routes = [];

	public static function add($route, $callback){
		$route = trim($route, '/');

		self::$routes[$route] = $callback;
	}

	public static function dispatch(){
		$uri = self::getUri();

		$params = [];

		$callback = null;
		foreach (self::$routes as $key => $value) {
			if (preg_match("%^{$key}$%", $uri, $params)) {
				$callback = $value;

				unset($params[0]);

				break;
			}
                }
		
		if (!$callback || !is_callable($callback)) {
			echo "View::error: na rota '$uri'";
			//View::error("route $uri");
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