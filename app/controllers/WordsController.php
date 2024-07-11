<?php 

require_once './app/models/Word.php';
require_once './app/models/Letter.php';

class WordsController{

    protected $wordModel;
    protected $letterModel;

    public function __construct() {
       $this->wordModel = new Word();
       $this->letterModel = new Letter();
    }

    public function index() {
        $letters = $this->getAllLetters();
        $this->render('admin_add_word', compact('letters'));
    }

    public function createWord() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $word = $_POST['word'];
            $letter_id = $_POST['letter_id'];
            $success = null;
            $error=null;

            $result = $this->wordModel->createWord($word, $letter_id);

            if ($result) {
                $success = "Palabra creada exitosamente.";
                header('Location: index.php?page=admin');
                exit();
            } else {
                $error = "Error al crear la palabra.";
            }

            $words = $this->wordModel->getAllWords();
            $this->render('admin_add_word', compact('words', 'success', 'error'));
        }
    }

    public function deleteWord() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'delete') {
            $wordId = $_GET['id'];

            $success = null;
            $error = null;

            $result = $this->wordModel->deleteWord($wordId);

            if ($result) {
                $success = "Palabra eliminada exitosamente.";
            } else {
                $error = "Error al eliminar la palabra.";
            }

            // Redirigir después de la eliminación
            $words = $this->wordModel->getAllWords();
            $this->render('admin', compact('words', 'success', 'error'));
        } else {
            // Manejar el caso en que no se envíe el método correctamente
            header('Location: index.php?page=admin');
            exit();
        }
    }

    public function getAllLetters() {
        return $this->letterModel->getLetters();
    }

    protected function render($view, $data = []) {
        require './app/views/templates/header.php';
        require "./app/views/$view.php";
        require './app/views/templates/footer.php';
    }
}