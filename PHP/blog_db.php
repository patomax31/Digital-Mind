<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "blog_db";

<<<<<<< HEAD
$conn = new mysqli($host, $user, $pass, $db);
=======
// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
>>>>>>> b2feb83 (Otra)

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
