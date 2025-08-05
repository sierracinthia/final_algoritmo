<?php

$host = 'mysql-db'; // nombre del servicio del docker-compose
$db   = 'sistema_cursos';
$user = 'admin';
$pass = 'admin123';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

} catch (\PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
}
function getPDO() {
    global $pdo;
    return $pdo;
}