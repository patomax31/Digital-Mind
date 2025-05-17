<?php
session_start();
require("blog_db.php");

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $clave = trim($_POST['password']);

    // Buscar en la tabla de administradores
    $stmtAdmin = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    $stmtAdmin->bind_param("s", $email);
    $stmtAdmin->execute();
    $resAdmin = $stmtAdmin->get_result();

    if ($resAdmin && $resAdmin->num_rows === 1) {
        $admin = $resAdmin->fetch_assoc();
        if (password_verify($clave, $admin['contraseña'])) {
            $_SESSION['admin'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_nombre'] = $admin['nombre'];
            header("Location: admin_panel.php");

            exit();
        }
    }

    // Buscar en la tabla de usuarios normales
    $stmtUser = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmtUser->bind_param("s", $email);
    $stmtUser->execute();
    $resUser = $stmtUser->get_result();

    if ($resUser && $resUser->num_rows === 1) {
        $user = $resUser->fetch_assoc();
        if (password_verify($clave, $user['contraseña'])) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nombre'] = $user['nombre'];

            header("Location: ../PHP/index.php");
            exit();
        } else {
            $mensaje = "<p class='message error'>Contraseña incorrecta.</p>";
        }
    } else {
        $mensaje = "<p class='message error'>No existe una cuenta con ese correo.</p>";
    }



    $stmtAdmin->close();
    $stmtUser->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Digital Mind</title>
    <link rel="stylesheet" href="../css/login_style.css">
    <style>
        .show-password {
            position: relative;
        }

        .show-password i {
            position: absolute;
            right: 10px;
            top: 20px; /* Ajustado para mejor alineación */
            cursor: pointer;
            /* Opcional: ajustar tamaño o color si es necesario */
            /* font-size: 1.2em; */
            /* color: #555; */
        }
    </style>
</head>
<body>
<div class="container">
    <div class="left-panel">
        <blockquote>
            “Simply all the tools that my team and I need.”
            <footer>– Karen Yue, Directora de Marketing</footer>
        </blockquote>
    </div>
    <div class="right-panel">
        <form action="login.php" method="post" id="loginForm">
            <h1>¡Bienvenido de nuevo!</h1>
            <p class="subtext">Ingrese sus datos</p>

            <?= $mensaje ?>

            <input type="email" id="email" name="email" placeholder="Correo electrónico" required>

            <div class="show-password">
                <input type="password" id="password" name="password" placeholder="Contraseña" required>
                <!-- Icono inicial de candado cerrado -->
                <i class="toggle-password" onclick="togglePassword()">🔒</i>
            </div>

            <label style="display:block; margin-top:10px;">
                <input type="checkbox" id="remember"> Recordarme
            </label>

            <button type="submit">Iniciar sesión</button>
            <a class="guest-link" href="../PHP/index.php">Ingresar como invitado</a>
            <a class="forgot-link" href="recovery.php">¿Olvidaste tu contraseña?</a>

            <p class="switch-auth">¿No tienes una cuenta? <a href="register.php">Regístrate</a></p>
        </form>
    </div>
</div>

<script>
    // Mostrar/Ocultar contraseña y cambiar icono
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const toggleIcon = document.querySelector(".toggle-password"); // Selecciona el icono

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.textContent = "🔓"; // Cambia a candado abierto
        } else {
            passwordInput.type = "password";
            toggleIcon.textContent = "🔒"; // Cambia a candado cerrado
        }
    }

    // Recordarme: usar localStorage
    const emailInput = document.getElementById("email");
    const rememberCheckbox = document.getElementById("remember");

    // Al cargar la página
    window.onload = () => {
        const savedEmail = localStorage.getItem("emailGuardado");
        if (savedEmail) {
            emailInput.value = savedEmail;
            rememberCheckbox.checked = true;
        }
    };

    // Al enviar el formulario
    document.getElementById("loginForm").addEventListener("submit", function () {
        if (rememberCheckbox.checked) {
            localStorage.setItem("emailGuardado", emailInput.value);
        } else {
            localStorage.removeItem("emailGuardado");
        }
    });
</script>
</body>
</html>

