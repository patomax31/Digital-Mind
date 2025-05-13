<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'blog_db';

$conex = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conex->connect_error) {
    die("Connection failed: " . $conex->connect_error);
}
?>
