<?php
session_start();
require("blog_db.php");

// Mostrar errores en desarrollo (puedes comentar o eliminar esto en producción)
ini_set('display_errors', 1);
error_reporting(E_ALL);

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $clave = trim($_POST['password']);

    // 1. Buscar en administradores
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
<<<<<<< HEAD
            header("Location: admin_panel.php");
=======
            header("Location: ../PHP/admin_panel.php");
>>>>>>> d660f715bf9ecc9589e41c778d0dbb865c9f97eb
            exit();
        }
    }

<<<<<<< HEAD
    // Buscar en la tabla de usuarios normales
=======
    // 2. Buscar en usuarios
>>>>>>> d660f715bf9ecc9589e41c778d0dbb865c9f97eb
    $stmtUser = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmtUser->bind_param("s", $email);
    $stmtUser->execute();
    $resUser = $stmtUser->get_result();

    if ($resUser && $resUser->num_rows === 1) {
        $user = $resUser->fetch_assoc();
        if (password_verify($clave, $user['contraseña'])) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nombre'] = $user['nombre'];
<<<<<<< HEAD
            header("Location: ../PHP/index.php");
=======
            header("Location: ../PHP/index.php"); // Redirige a la página principal
>>>>>>> d660f715bf9ecc9589e41c778d0dbb865c9f97eb
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
    <!-- Asegúrate de que esta ruta sea correcta -->
    <link rel="stylesheet" href="../css/login_style.css">
    <style>
        /* Estilos específicos para el contenedor del campo de contraseña y el icono */
        .show-password {
            position: relative;
            width: 100%; /* Asegura que ocupe el ancho del form-group */
        }

        /* Estilos para el icono (el "botón") */
        .show-password i {
            position: absolute;
            right: 10px; /* Posición desde la derecha */
            top: 50%; /* Centra verticalmente */
            transform: translateY(-50%); /* Ajuste fino para centrar */
            cursor: pointer;
            color: #555; /* Color del icono */
            font-size: 1.2em; /* Tamaño del icono */
            z-index: 2; /* Asegura que esté por encima del input */
        }

        /* Ajuste para el input dentro de show-password para dejar espacio al icono */
        .show-password input[type="password"],
        .show-password input[type="text"] {
             padding-right: 35px; /* Deja espacio para el icono */
             /* No necesitamos width: calc(100% - 35px); aquí si el input ya tiene width: 100% y box-sizing: border-box */
             /* width: 100%; /* Asegura que ocupe el ancho del contenedor show-password */
             box-sizing: border-box; /* Incluye padding y borde en el ancho */
        }

        /* Ajuste para la etiqueta Recordarme dentro de form-group */
        /* Usar Flexbox para alinear el checkbox y el texto */
        .form-group label[for="remember"] {
             display: flex; /* Usa Flexbox */
             align-items: center; /* Centra verticalmente los elementos hijos (checkbox y texto) */
             margin-bottom: 0;
             margin-top: 0;
             font-size: 1em; /* Ajusta el tamaño si es necesario */
             color: #4a4a4a;
             /* vertical-align: middle; /* No necesario con Flexbox */
        }

        /* Estilo específico para el checkbox dentro de la etiqueta Recordarme */
        .form-group label[for="remember"] input[type="checkbox"] {
            /* vertical-align: middle; /* No necesario con Flexbox */
            margin-right: 290px; /* Añade un pequeño espacio entre el checkbox y el texto */
            /* Asegura que no haya márgenes o padding inesperados */
            margin-top: 0;
            margin-bottom: 0;
            padding: 0;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="left-panel">
        <blockquote>
            “Invertir en la educacion es invertir en el futuro.”
        </blockquote>
    </div>
    <div class="right-panel">
        <form action="login.php" method="post" id="loginForm">
            <h1>¡Bienvenido de nuevo!</h1>
            <p class="subtext">Ingrese sus datos</p>

            <?= $mensaje ?>

            <!-- Campo de Email envuelto en form-group -->
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" placeholder="Correo electrónico" required>
            </div>

            <!-- Campo de Contraseña con icono, envuelto en form-group -->
            <div class="form-group">
                 <label for="password">Contraseña</label>
                <div class="show-password">
                    <input type="password" id="password" name="password" placeholder="Contraseña" required>
                    <!-- Icono inicial de candado cerrado (o el que prefieras) -->
                    <i class="toggle-password" onclick="togglePassword()">🔒</i>
                </div>
            </div>

            <!-- Checkbox Recordarme envuelto en form-group -->
            <div class="form-group">
                <label for="remember">
                    <input type="checkbox" id="remember"> Recordarme
                </label>
            </div>

            <button type="submit">Iniciar sesión</button>
            <!-- Asegúrate de que esta ruta sea correcta -->
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
            // O si usas Font Awesome: toggleIcon.classList.replace('fa-lock', 'fa-unlock');
        } else {
            passwordInput.type = "password";
            toggleIcon.textContent = "🔒"; // Cambia a candado cerrado
             // O si usas Font Awesome: toggleIcon.classList.replace('fa-unlock', 'fa-lock');
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
