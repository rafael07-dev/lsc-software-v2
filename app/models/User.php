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

    public function updatePassword($username, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $query = "UPDATE users SET password = ? WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $hashedPassword, $username);
        
        if ($stmt->execute()) {
            return true; // Actualización exitosa
        } else {
            return false; // Error al actualizar
        }
    }

    public function createUser($username, $hashedPassword) {
        $stmt = $this->db->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        $stmt->bind_param('ss', $username, $hashedPassword);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
}
