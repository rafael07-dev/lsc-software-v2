<?php 
    class App{

        public function __construct()
        {
            
        }

        public function run()
        {
            if(isset($_GET['uri'])){
                $url = $_GET['uri'];
                $url = rtrim($url, '/');
                $url = explode('/', $url);
    
                $controllerName = $url[0] . "Controller";
                $pathController = "./app/controllers/".$controllerName.".php";
            }

            $controllerName = "MainController";

            $pathController = "./app/controllers/".$controllerName.".php";

            if (file_exists($pathController)) {
                require_once($pathController);

                $controller = new $controllerName;

                $methodName = isset($url[1]) ? $url[1] : "index";

                $controller->{$methodName}();
            }

        }
    }

?>