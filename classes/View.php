<?php
    class View {
        public static function render($view, $params = []) {
            foreach ($params as $key => $value)
                $$key = $value;

            $file = VIEWS_PATH . "$view.php";
            if(file_exists($file))
                require_once $file;
            else
                self::error('file');
        }

        public static function error($errorMessage) {
            require_once ERROR_VIEW_PATH;
        }

        public static function clientError($errorMessage, $link){
            require_once CLIENT_ERROR_VIEW_PATH;
        }
        
    }

?>