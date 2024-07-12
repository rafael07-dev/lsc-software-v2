<?php

require_once __DIR__ . '/Letter.php';

class Word {

    private $db;

    public function __construct() {
        $this->db = new mysqli("localhost", "root", "", "lsc-software");
    }

    public function createWord($word, $letter_id){
        // Preparar la consulta SQL para insertar una nueva palabra
        $query = "INSERT INTO words (word, letter_id) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);

        // Vincular los parámetros
        $stmt->bind_param("si", $word, $letter_id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteWord($word_id) {
        $query = "DELETE FROM words WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $word_id);
        return $stmt->execute();
    }

    public function updateWord($word_id, $word, $letter_id) {
        $stmt = $this->db->prepare("UPDATE words SET word = ?, letter_id = ? WHERE id = ?");
        $stmt->bind_param("sii", $word, $letter_id, $word_id);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getWordById($id) {
        // Preparar la consulta SQL
        $query = "SELECT * FROM words WHERE id = ?";
        $stmt = $this->db->prepare($query);

        if ($stmt === false) {
            die('Error al preparar la consulta: ' . $this->db->error);
        }

        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param('i', $id);
        $stmt->execute();

        // Obtener el resultado de la consulta
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null; // No se encontró ninguna palabra con ese ID
        }

        // Obtener los datos de la palabra
        $word = $result->fetch_assoc();

        // Cerrar la declaración y devolver los datos de la palabra
        $stmt->close();

        return $word;
    }

    public function getAllWords() {
        $query = "SELECT * FROM words";
        $result = $this->db->query($query);

        $words = [];
        while ($row = $result->fetch_assoc()) {
            $words[] = $row;
        }
        return $words;
    }

    // Método para obtener palabras que comienzan con una letra específica
    public function getWordsByLetter($letter) {
        // Primero obtener letter_id desde la letra
        $letterModel = new Letter();
        $letterId = $letterModel->getLetterId($letter);

        if (!$letterId) {
            return []; // Retornar array vacío si no se encuentra el letter_id
        }

        // Ahora obtener las palabras basadas en letter_id
        $query = "SELECT id, word FROM words WHERE letter_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $letterId);
        $stmt->execute();
        $result = $stmt->get_result();
        $words = [];
        while ($row = $result->fetch_assoc()) {
            $words[] = $row;
        }
        return $words;
    }

    public function getWordByLetterId($letterId){
        $query = "SELECT id, word FROM words WHERE letter_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $letterId);
        $stmt->execute();
        $result = $stmt->get_result();

        $words = [];

        while ($row = $result->fetch_assoc()){
            $words[] = $row;
        }
        return $words;
    }
}
