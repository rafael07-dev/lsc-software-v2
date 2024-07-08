<?php

require_once './config/db_conexion.php';

class User {
    private $db;

    public function __construct()
    {
        $this->db = Connection::connect();
    }

    public function getUserByUsername($username) {
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
