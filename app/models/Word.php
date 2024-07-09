<?php

require_once __DIR__ . '/Letter.php';

class Word {

    private $db;

    public function __construct() {
        $this->db = new mysqli("localhost", "root", "", "lsc-software");
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
