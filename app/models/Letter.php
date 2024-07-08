<?php

class Letter {
    private $db;

    public function __construct() {
        $this->db = Connection::connect();
    }

    public function getLetters() {
        $query = "SELECT id, letter FROM letters";
        $result = $this->db->query($query);
        $letters = [];
        while ($row = $result->fetch_assoc()) {
            $letters[] = $row;
        }
        return $letters;
    }

    public function getLetterId($letter) {
        $query = "SELECT id FROM letters WHERE letter = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $letter);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row ? $row['id'] : null;
    }
}
