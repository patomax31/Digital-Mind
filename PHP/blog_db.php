<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "blog_db";

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conex->connect_error) {
    die("Connection failed: " . $conex->connect_error);
}
?>
