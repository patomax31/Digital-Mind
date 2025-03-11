<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validaciones básicas
    if ($password !== $confirm_password) {
        echo "Las contraseñas no coinciden.";
    } else {
        // Aquí puedes guardar los datos en una base de datos o hacer otras operaciones
        echo "Formulario enviado correctamente.";
        echo "<br>Nombre: " . $nombre;
        echo "<br>Email: " . $email;
        echo "<br>Contraseña: " . $password;
    }
}
?>