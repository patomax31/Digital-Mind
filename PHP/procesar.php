<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido = htmlspecialchars($_POST['apellido']); // Nuevo campo
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    // Datos de conexión
    $host = "localhost";
    $usuario = "root";
    $clave = "";
    $bd = "formulario_contacto";

    $conn = new mysqli($host, $usuario, $clave, $bd);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "INSERT INTO mensajes (nombre, apellido, email, mensaje) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $apellido, $email, $mensaje);

    if ($stmt->execute()) {
        echo "<h2>Gracias por tu mensaje, $nombre $apellido.</h2>";
    } else {
        echo "Error al guardar el mensaje: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acceso no permitido.";
}
?>
