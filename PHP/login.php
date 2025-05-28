<?php
session_start();
include("blog_db.php");
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Buscar usuario por email
        $stmt = mysqli_prepare($conn, "SELECT id, nombre, contraseña FROM usuarios WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
    }
    // 2. Buscar en usuarios
$stmtUser = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
$stmtUser->bind_param("s", $email);
$stmtUser->execute();
$resUser = $stmtUser->get_result();


    if ($resAdmin && $resAdmin->num_rows === 1) {
        $admin = $resAdmin->fetch_assoc();
        if (password_verify($clave, $admin['contraseña'])) {
            $_SESSION['adminw'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_nombre'] = $admin['nombre'];
            header("Location: ../PHP/admin_panel.php");
            exit();
        }
    }

  
if ($resUser && $resUser->num_rows === 1) {
    $user = $resUser->fetch_assoc();
    if (password_verify($clave, $user['contraseña'])) {
        $_SESSION['usuario'] = [
            'id' => $user['id'],
            'nombre' => $user['nombre']
        ];
        header("Location: ../PHP/index.php"); // Redirige a la página principal
        exit();
    } else {
        $mensaje = "<p class='message error'>Contraseña incorrecta.</p>";
    }
} else {
        $mensaje = "<p class='message error'>No existe una cuenta con ese correo.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Digital Mind</title>
    <link rel="stylesheet" href="../css/login_style.css">
    <style>
        .show-password {
            position: relative;
            width: 100%;
        }

        .show-password i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #555;
            font-size: 1.2em;
            z-index: 2;
        }

        .show-password input[type="password"],
        .show-password input[type="text"] {
             padding-right: 35px;
             box-sizing: border-box;
        }

        .form-group {
            width: 100%;
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            color: #4a4a4a;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1em;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="left-panel">
        <blockquote>
            "El conocimiento es poder, y el poder es la capacidad de transformar el mundo."
        </blockquote>
    </div>
    <div class="right-panel">
        <form action="../PHP/login.php" method="post">
            <h1>¡Bienvenido de vuelta!</h1>
            <p class="subtext">Inicia sesión en tu cuenta</p>

            <?= $mensaje ?>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <div class="show-password">
                    <input type="password" id="password" name="password" placeholder="Contraseña" required>
                    <i class="toggle-password" onclick="togglePassword()">🔒</i>
                </div>
            </div>

            <button type="submit">Iniciar Sesión</button>
            <a class="guest-link" href="../PHP/index.php">Ingresar como invitado</a>
            <a class="forgot-link" href="../PHP/recovery.php">¿Olvidaste tu contraseña?</a>

            <p class="switch-auth">¿No tienes una cuenta? <a href="register.php">Registrarse</a></p>
        </form>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const toggleIcon = passwordInput.nextElementSibling;

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.textContent = "🔓";
        } else {
            passwordInput.type = "password";
            toggleIcon.textContent = "🔒";
        }
    }

</script>
</body>
</html>