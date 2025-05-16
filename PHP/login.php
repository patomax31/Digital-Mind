<?php
include("blog_db.php");
session_start();

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // 1. Buscar en administradores
    $consulta_admin = "SELECT * FROM admin WHERE email = ?";
    $stmt = $conn->prepare($consulta_admin);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado_admin = $stmt->get_result();

    if ($resultado_admin && $resultado_admin->num_rows == 1) {
        $admin = $resultado_admin->fetch_assoc();
        if (password_verify($password, $admin['contraseña'])) {
            $_SESSION['admin'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_nombre'] = $admin['nombre'];
            header("Location: panel_admin.php");
            exit();
        }
    }

    // 2. Buscar en usuarios normales
    $consulta_user = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($consulta_user);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado_user = $stmt->get_result();

    if ($resultado_user && $resultado_user->num_rows == 1) {
        $usuario = $resultado_user->fetch_assoc();
        if (password_verify($password, $usuario['contraseña'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            header("Location: ../PHP/index.php");
            exit();
        } else {
            $mensaje = "<p class='message error'>Contraseña incorrecta.</p>";
        }
    } else {
        $mensaje = "<p class='message error'>No existe una cuenta con ese correo.</p>";
    }

    $stmt->close();
}
?>
