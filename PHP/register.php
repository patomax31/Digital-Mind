<?php
include("blog_db.php");
$mensaje = "";

function verificarEmail($email) {
    $api_key = 'test_ead774bd4057984fb0ad5d3c4e19944790c6199b579135c5f4a4746e15c65578';
    $url = "https://api.kickbox.com/v2/verify?email=" . urlencode($email) . "&apikey=" . $api_key;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['nombre']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
        $nombre = trim($_POST['nombre']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);

     $stmt = mysqli_prepare($conn, "SELECT * FROM usuarios WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$resultado_email = mysqli_stmt_get_result($stmt);

if ($resultado_email && mysqli_num_rows($resultado_email) > 0) {
    $mensaje = "<p class='message error'>¡Este correo ya está registrado!</p>";
}

        if (mysqli_num_rows($resultado_email) > 0) {
            $mensaje = "<p class='message error'>¡Este correo ya está registrado!</p>";
        } elseif ($password !== $confirm_password) {
            $mensaje = "<p class='message error'>¡Las contraseñas no coinciden!</p>";
        } else {
            $verificacion = verificarEmail($email);
            if ($verificacion && $verificacion['success']) {
                if ($verificacion['result'] == 'deliverable' && !$verificacion['disposable']) {
                    $password_hashed = password_hash($password, PASSWORD_BCRYPT);
                    $consulta = "INSERT INTO usuarios (nombre, email, contraseña) VALUES ('$nombre', '$email', '$password_hashed')";
                    $resultado = mysqli_query($conn, $consulta);

                    if ($resultado) {
                        $mensaje = "<p class='message success'>¡Registro exitoso! Redirigiendo...</p>";
                        header("Refresh: 2; url=index.php");
                    } else {
                        $mensaje = "<p class='message error'>Error al registrar usuario.</p>";
                    }
                } else {
                    $mensaje = "<p class='message error'>Correo no válido: " . htmlspecialchars($verificacion['reason']) . "</p>";
                }
            } else {
                $mensaje = "<p class='message error'>Error al verificar el correo electrónico.</p>";
            }
        }
    } else {
        $mensaje = "<p class='message error'>Completa todos los campos.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Nucleus UI</title>
    <link rel="stylesheet" href="../css/login_style.css">
</head>
<body>
<div class="container">
    <div class="left-panel">
        <blockquote>
            “Simply all the tools that my team and I need.”
            <footer>– Karen Yue, Director of Digital Marketing Technology</footer>
        </blockquote>
    </div>
    <div class="right-panel">
        <form action="register.php" method="post">
            <h1>¡Bienvenido a Digital Mind!</h1>
            <p class="subtext">Crea tu cuenta</p>

            <?= $mensaje ?>

            <input type="text" name="nombre" placeholder="Nombre de usuario" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="password" name="confirm_password" placeholder="Confirmar contraseña" required>

            <button type="submit">Registrate</button>
            <a class="guest-link" href="index.php">Ingresar como invitado</a>
            <a class="forgot-link" href="../PHP/recovery.php">¿Olvidaste tu contraseña?</a>

            <p class="switch-auth">¿Ya tienes una cuenta? <a href="login.php">Iniciar sesión</a></p>
        </form>
    </div>
</div>
</body>
</html>
