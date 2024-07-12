<?php

require_once './app/controllers/DiccionarioController.php';
//require_once './app/controllers/AprendizajeController.php';
require_once './app/controllers/WordsController.php';
require_once './app/controllers/MainController.php';
require_once './app/controllers/AdminController.php';

class Router {
    protected $routes = [];

    public function __construct() {
        $this->initRoutes();
    }

    protected function initRoutes() {
        // Define las rutas disponibles y los controladores asociados
        $this->routes = [
            'main' => ['controller' => 'MainController', 'method' => 'index'],
            'diccionario' => ['controller' => 'DiccionarioController', 'method' => 'index'],
            'aprendizaje' => ['controller' => 'AprendizajeController', 'method' => 'index'],
            'quiz' => ['controller' => 'QuizController', 'method' => 'index'],
            'admin' => ['controller' => 'AdminController', 'method' => 'index'],
            'admin_login' => ['controller' => 'AdminController', 'method' => 'login'],
            'admin_add_word' => ['controller' => 'WordsController', 'method' => 'index'],
            'admin_edit_word' => ['controller' => 'WordsController', 'method' => 'editWord'],
            'update_word' => ['controller' => 'WordsController', 'method' => 'updateWord'],
            'create_word' => ['controller' => 'WordsController', 'method' => 'createWord'],
            'delete_word' => ['controller' => 'WordsController', 'method' => 'deleteWord'],
            'admin_create_user' => ['controller' => 'AdminController', 'method' => 'createUser'],
            'admin_update_password' => ['controller' => 'AdminController', 'method' => 'updatePassword'],
            'admin_logout' => ['controller' => 'AdminController', 'method' => 'logout'],
            'default' => ['controller' => 'MainController', 'method' => 'index'], // Ruta por defecto
        ];
    }

    public function run() {
        // Obtener la ruta solicitada
        $requestedRoute = isset($_GET['page']) ? $_GET['page'] : 'main';
        
        // Validar si la ruta solicitada existe en el enrutador
        if (array_key_exists($requestedRoute, $this->routes)) {
            // Incluir el controlador correspondiente

            $controllerName = $this->routes[$requestedRoute]['controller'];
            $methodName = $this->routes[$requestedRoute]['method'];

            $controllerFile = './app/controllers/' . $controllerName . '.php'; 
            
            if (file_exists($controllerFile)) {
                require_once $controllerFile;

                // Instanciar el controlador y llamar al método
                $controller = new $controllerName();
                if (method_exists($controller, $methodName)) {
                    $controller->$methodName();
                } else {
                    $this->routeNotFound();
                }
            } else {
                $this->routeNotFound();
            }
        } else {
            // Si la ruta no existe, mostrar una página de error 404
            $this->routeNotFound();
        }
    }

    protected function routeNotFound() {
        // Manejar la situación cuando la ruta no existe
        include './app/views/page404.php';
    }
}

?>
