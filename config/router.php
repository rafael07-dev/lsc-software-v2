<?php

require_once './app/controllers/DiccionarioController.php';

class Router{

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
            'perfil' => ['controller' => 'PerfilController', 'method' => 'index'],
            'default' => ['controller' => 'MainController', 'method' => 'index'], // Ruta por defecto
        ];
    }

    public function run() {
        // Obtener la ruta solicitada
        $requestedRoute = isset($_GET['page']) ? $_GET['page'] : 'main';
        
        // Validar si la ruta solicitada existe en el enrutador
        if (array_key_exists($requestedRoute, $this->routes)) {
            // Incluir la vista correspondiente

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

