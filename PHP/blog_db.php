<?php
<<<<<<< HEAD
=======

>>>>>>> 42d7dbd (Arreglos)
$host = "localhost";
$user = "root";
$pass = "";
$db = "blog_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error); 
}
?>
