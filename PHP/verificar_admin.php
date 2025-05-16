<?php
include("blog_db.php"); // Asegúrate de que esta conexión esté bien

$nombre = $_POST['nombre'];
$contraseña = $_POST['contraseña'];

$consulta = "SELECT * FROM admin WHERE nombre = '$nombre'";
$resultado = mysqli_query($conn, $consulta);

if ($fila = mysqli_fetch_assoc($resultado)) {
    if (password_verify($clave, $fila['clave'])) {
        echo "¡Bienvenido, Admin!";
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "Usuario no encontrado.";
}
?>