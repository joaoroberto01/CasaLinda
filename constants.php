<?php
	date_default_timezone_set('America/Sao_Paulo');
	
	define('PROJECT_NAME', 'Casa Linda');

	define('ROOT_PATH', '/casa_linda/');

	# RESOURCES
	define('BS_PATH', ROOT_PATH . 'res/bootstrap');
	define('BS_CSS_PATH', ROOT_PATH . 'res/bootstrap/css/bootstrap.css');
	define('BS_JS_PATH', ROOT_PATH . 'res/bootstrap/js/bootstrap.js');
	define('BS_BUNDLE_JS_PATH', ROOT_PATH . 'res/bootstrap/js/bootstrap.bundle.js');

	define('BS_MULTISELECT_CSS_PATH', ROOT_PATH . 'res/bs-multiselect/css/BsMultiSelect.css');
	define('BS_MULTISELECT_JS_PATH', ROOT_PATH . 'res/bs-multiselect/js/BsMultiSelect.js');

	define('IMG_PATH', ROOT_PATH . 'res/img');
	define('CSS_PATH', ROOT_PATH . 'res/css');
	define('JS_PATH', ROOT_PATH . 'res/js');
	define('VARIABLES_CSS_PATH', ROOT_PATH . 'res/css/variables.css');
	define('DEFAULT_CSS_PATH', ROOT_PATH . 'res/css/styles.css');

	define('PRODUCT_IMAGES_PATH', 'product_images/');
	define('CLASSES_PATH', 'classes/');
	define('CONTROLLERS_PATH', CLASSES_PATH . 'controllers/');
	define('VIEWS_PATH', 'views/');

	# VIEWS 
	define('EMAIL_TEMPLATES_PATH', VIEWS_PATH . 'email_templates');
	define('ERROR_VIEW_PATH', VIEWS_PATH . 'error.php');
	define('CLIENT_ERROR_VIEW_PATH', VIEWS_PATH . 'client_error.php');

	define('INACTIVITY_TIME', 600);
	define('RESTOCK_LIMIT', 5);
?>