<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Formulario de Registro</h2>
    <form action="main_page.html" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br>

        <label for="bday">Fecha de Nacimiento:</label>
        <input type="date" name="bday" required><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" required><br>

        <button type="submit">Registrarse</button>
    </form>
</body>
</html>

<?php
$servername = "127.0.0.1";
$username = "root";  // Ajusta según tu configuración
$password = "";      // Ajusta según tu configuración
$dbname = "test"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptar la contraseña
$bday = $_POST['bday'];
$cantidad = intval($_POST['cantidad']); 

// Insertar datos en la base de datos
$sql = "INSERT INTO usuarios (nombre, apellido, email, contraseña, bday, cantidad) 
        VALUES ('$nombre', '$apellido', '$email', '$password', '$bday', $cantidad)";

if ($conn->query($sql) === TRUE) {
    echo "Registro exitoso";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
