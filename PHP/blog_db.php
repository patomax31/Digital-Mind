<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "blog_db";

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
