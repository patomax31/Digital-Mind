<?php
// db.php

$host = 'localhost';
$dbname = 'db';
$username = 'root';
$password = '123456789';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
}
?>