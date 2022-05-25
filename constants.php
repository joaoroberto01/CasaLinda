<?php
	date_default_timezone_set('America/Sao_Paulo');
	
	define('PROJECT_NAME', 'Casa Linda');

	define('ROOT_PATH', '/casa_linda/');

	# RESOURCES
	define('BS_CSS_PATH', ROOT_PATH . 'res/bootstrap/css/bootstrap.css');
	define('BS_JS_PATH', ROOT_PATH . 'res/bootstrap/js/bootstrap.js');
	define('IMG_PATH', ROOT_PATH . 'res/img');
	define('CSS_PATH', ROOT_PATH . 'res/css');
	define('JS_PATH', ROOT_PATH . 'res/js');
	define('VARIABLES_CSS_PATH', ROOT_PATH . 'res/css/variables.css');
	define('DEFAULT_CSS_PATH', ROOT_PATH . 'res/css/styles.css');

	
	define('CLASSES_PATH', 'classes/');
	define('CONTROLLERS_PATH', CLASSES_PATH . 'controllers/');
	define('VIEWS_PATH', 'views/');

	# VIEWS 
	define('EMAIL_TEMPLATES_PATH', VIEWS_PATH . 'email_templates');
	define('ERROR_VIEW_PATH', VIEWS_PATH . 'error.php');

	define('INACTIVITY_TIME', 600);
?>