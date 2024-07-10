<?php

require_once './app/models/User.php';
require_once './app/models/Word.php';

class AdminController {

    protected $userModel;
    protected $wordModel;

    public function __construct() {
        $this->userModel = new User();
        $this->wordModel = new Word();
    }

    public function index() {
        session_start();
        // Verificar si el usuario está autenticado
        $this->requireLogin();
        $words = $this->wordModel->getAllWords();

        // Lógica para mostrar la vista del panel de administrador
        $this->render('admin', compact('words'));
        //require_once './app/views/admin.php';
    }

    public function login() {
        // Lógica para mostrar el formulario de inicio de sesión
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesar el inicio de sesión
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Validar las credenciales del usuario
            $user = $this->userModel->getUserByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                // Iniciar sesión y redirigir al panel de administrador
                session_start();
                $_SESSION['username'] = $username;
                header('Location: index.php?page=admin');
                exit;
            } else {
                // Mostrar mensaje de error si las credenciales son incorrectas
                $error = "Credenciales incorrectas. Inténtalo de nuevo.";
            }
        }

        // Mostrar el formulario de inicio de sesión
        require_once './app/views/admin_login.php';
    }

    public function updatePassword() {
        // Lógica para mostrar el formulario de actualización de contraseña
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesar el formulario de actualización de contraseña
            $username = $_POST['username'];
            $newPassword = $_POST['new_password'];

            // Llamar al método updatePassword del modelo User
            $success = $this->userModel->updatePassword($username, $newPassword);

            if ($success) {
                $message = "¡Contraseña actualizada correctamente!";
            } else {
                $error = "Hubo un problema al actualizar la contraseña. Inténtalo de nuevo.";
            }
        }

        // Mostrar el formulario de actualización de contraseña
        require_once './app/views/update_password_form.php';
    }

    public function createUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Aquí podrías agregar validaciones adicionales si es necesario

            // Hashear la contraseña
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Guardar el usuario en la base de datos
            $success = $this->userModel->createUser($username, $hashedPassword);

            if ($success) {
                // Redirigir o mostrar mensaje de éxito
                header('Location: index.php?page=admin');
                exit;
            } else {
                // Manejar el error, por ejemplo:
                $error = "Error al crear el usuario. Inténtalo de nuevo.";
            }
        }

        // Mostrar el formulario de creación de usuario
        require_once './app/views/admin_create_user.php';
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: index.php?page=admin_login&action=login');
        exit;
    }

    protected function requireLogin() {
        if (!isset($_SESSION['username'])) {
            header('Location: index.php?page=admin_login');
            exit;
        }
    }

    protected function render($view, $data = []) {
        require './app/views/templates/header.php';
        require "./app/views/$view.php";
        require './app/views/templates/footer.php';
    }
}
?>
