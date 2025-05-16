<?php
// Parámetros de conexión
$db_host = 'localhost';
$db_user = 'root';
$db_pass = ''; // XAMPP usa contraseña vacía por defecto
$db_name = 'blog_db';

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>

<?php
// Database connection parameters
//$db_host = 'localhost';
//$db_user = 'root';
//$db_pass = ''; // XAMPP default is empty password
//$db_name = 'blog_db'; // Make sure this matches your actual database name

// Create connection
//$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
//if ($conn->connect_error) { 
 //   die("Connection failed: " . $conn->connect_error);
//}
//?>