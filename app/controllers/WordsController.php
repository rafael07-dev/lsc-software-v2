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

                $letters = $this->getAllLetters();
                $words = $this->getAllWords();
                $this->render('admin', compact('words', 'letters', 'success', 'error'));
                
                exit;
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

    public function editWord() {
        if (isset($_GET['id'])) {
            $wordId = $_GET['id'];
            // Aquí deberías cargar los datos de la palabra usando el modelo correspondiente
            $word = $this->wordModel->getWordById($wordId);
            $letters = $this->getAllLetters();
            
            if ($word) {
                // Renderizar la vista para editar la palabra, pasando los datos necesarios
                $this->render('admin_edit_word', compact('word', 'letters'));
            } else {
                // Manejar el caso en el que no se encuentre la palabra
                $error = "La palabra no existe.";
                $this->render('admin', compact('error'));
            }
        } else {
            // Manejar el caso en el que no se proporcionó un ID de palabra válido
            $error = "ID de palabra no proporcionado.";
            $this->render('admin', compact('error'));
        }
    }
    

    public function updateWord() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $word_id = $_POST['word_id'];
            $word = $_POST['word'];
            $letter_id = $_POST['letter_id'];

            //mesanjes de error
            $error = null;
            $success = null;
    
            $result = $this->wordModel->updateWord($word_id, $word, $letter_id);
    
            if ($result) {
                $success = "Palabra actualizada exitosamente.";
            } else {
                $error = "Error al actualizar la palabra.";
            }
    
            $words = $this->wordModel->getAllWords();
            $letters = $this->letterModel->getLetters();
            $this->render('admin', compact('words', 'letters', 'success', 'error'));
        }
    }
    

    public function getAllLetters() {
        return $this->letterModel->getLetters();
    }

    public function getAllWords() {
        return $this->wordModel->getAllWords();
    }

    protected function render($view, $data = []) {
        require './app/views/templates/header.php';
        require "./app/views/$view.php";
        require './app/views/templates/footer.php';
    }
}