<?php

class Connection {

    private static $db;

    public static function connect() {
        if (self::$db === null) {
            self::$db = new mysqli('localhost', 'root', '', 'lsc-software');

            if (self::$db->connect_error) {
                die("Error de conexión: " . self::$db->connect_error);
            }
        }
        return self::$db;
    }
}
