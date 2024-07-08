<?php

class Video {
    private $db;

    public function __construct() {
        $this->db = new mysqli("localhost", "root", "", "lsc-software");
    }

    public function getVideoByWordId($wordId) {
        $query = "SELECT gif_url FROM gifs WHERE word_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $wordId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row ? $row['gif_url'] : null;
    }
}
?>
