<?php
// Database connection parameters
$db_host = 'localhost';
$db_user = 'root';
$db_pass = ''; // XAMPP default is empty password
$db_name = 'blog_db'; // Make sure this matches your actual database name

// Create connection
$conex = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>