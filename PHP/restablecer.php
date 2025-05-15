<?php
include("blog_db.php"); // Conexión a la base de datos
$mensaje = "";

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verificar el token en la base de datos
    $consulta = "SELECT email, reset_expira FROM usuarios WHERE reset_token = ?";
    $stmt = mysqli_prepare($conex, $consulta);
    mysqli_stmt_bind_param($stmt, "s", $token);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $fila = mysqli_fetch_assoc($resultado);

    if ($fila && $fila['reset_expira'] > time()) {
        $email = $fila['email'];
        
        // Procesar nueva contraseña
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm_password']);

            if ($password === $confirm_password) {
                $password_hashed = password_hash($password, PASSWORD_BCRYPT);
                $update = "UPDATE usuarios SET contraseña = ?, reset_token = NULL, reset_expira = NULL WHERE email = ?";
                $stmt_update = mysqli_prepare($conex, $update);
                mysqli_stmt_bind_param($stmt_update, "ss", $password_hashed, $email);
                mysqli_stmt_execute($stmt_update);

                $mensaje = "<h3 class='ok'>¡Tu contraseña ha sido restablecida!</h3>";
            } else {
                $mensaje = "<h3 class='bad'>¡Las contraseñas no coinciden!</h3>";
            }
        }
    } else {
        $mensaje = "<h3 class='bad'>¡Token inválido o expirado!</h3>";
    }
} else {
    $mensaje = "<h3 class='bad'>¡Token no proporcionado!</h3>";
}
?>