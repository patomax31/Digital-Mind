<?php
<<<<<<< HEAD
$host = "localhost";
$user = "root";
$pass = "";
$db = "blog_db";

=======

$host = "localhost";
$user = "root";
$pass = "";
$db = "blog_db";

>>>>>>> b96bec3519df3943985c14a12020efe15b8ecff7
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error); 
}
?>
<<<<<<< HEAD
=======

>>>>>>> b96bec3519df3943985c14a12020efe15b8ecff7
