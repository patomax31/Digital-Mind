<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = ''; 
$db_name = 'blog_db';

<<<<<<< HEAD
=======
// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
>>>>>>> 7dc266b (Marcianos)

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
