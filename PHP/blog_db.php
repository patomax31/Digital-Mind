<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "blogs";

$conn = new mysqli($host, $user, $pass, $dbname);

if($conn->connect_error){
    die("Error de conexion: " . $conn->connect_error);
}

?>
