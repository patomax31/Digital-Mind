<?php
<<<<<<< HEAD
$db_host = 'localhost';
$db_user = 'root';
$db_pass = ''; 
$db_name = 'blog_db';
=======
$host = "localhost";
$user = "root";
$pass = "";
$db = "blog_db";
>>>>>>> 58f5051 (Cambios)

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
<<<<<<< HEAD
=======
?>
>>>>>>> 58f5051 (Cambios)
