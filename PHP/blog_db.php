<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = ''; 
$db_name = 'blog_db';


// Check connection
if ($conex->connect_error) {
    die("Connection failed: " . $conex->connect_error);
}
?>
