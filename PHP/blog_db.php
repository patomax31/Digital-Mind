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
>>>>>>> 3052f1a58a42fd63fc4ea0e7c17bb358fbb04f67

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
