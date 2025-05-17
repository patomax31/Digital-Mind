<?php
require("blog_db.php");

$nombre = "Administrador";
$email = "admin@ejemplo.com";
$clave_plana = "admin123";
$clave_hash = password_hash($clave_plana, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO admin (nombre, email, contraseña) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nombre, $email, $clave_hash);

if ($stmt->execute()) {
    echo "Administrador creado correctamente.";
} else {
    echo "Error al crear admin: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>
