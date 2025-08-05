<?php
class PersonaModel {
    private $conn;

    public function __construct() {
        $this->conn = new PDO("mysql:host=mysql-db;dbname=nombre_de_tu_bd", "usuario", "clave");
    }

    public function crearPersona($nombre, $apellido, $dni, $fecha_nac) {
        $stmt = $this->conn->prepare("INSERT INTO persona (nombre, apellido, dni, fecha_nacimiento) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nombre, $apellido, $dni, $fecha_nac]);
        return $this->conn->lastInsertId();
    }
}
