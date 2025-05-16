<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "blog_db";

// Create connection
$conex = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conex->connect_error) {
    die("Connection failed: " . $conex->connect_error);
}
?>
