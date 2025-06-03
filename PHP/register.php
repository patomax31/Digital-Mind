<?php

session_start();
include("blog_db.php");
$mensaje = "";

function verificarEmail($email) {
    // Considera mover la API key a un archivo de configuración seguro
    $api_key = 'test_ead774bd4057984fb0ad5d3c4e19944790c6199b579135c5f4a4746e15c65578';
    $url = "https://api.kickbox.com/v2/verify?email=" . urlencode($email) . "&apikey=" . $api_key;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Opcional: Ignorar verificación SSL en entorno de desarrollo si es necesario (NO HACER EN PRODUCCIÓN)
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Obtener código de respuesta HTTP
    $curl_error = curl_error($ch); // Obtener errores de cURL
    curl_close($ch);

    if ($response === false) {
        // Manejar error de cURL
        error_log("Error cURL al verificar email: " . $curl_error);
        return ['success' => false, 'message' => 'Error de conexión al verificar email.'];
    }

    $verificacion = json_decode($response, true);

    if ($http_code !== 200) {
        // Manejar errores de la API (ej. API key inválida, límite excedido)
        error_log("Error API Kickbox (HTTP " . $http_code . "): " . ($verificacion['message'] ?? 'Error desconocido'));
        return ['success' => false, 'message' => 'Error de la API de verificación de email.'];
    }

    return $verificacion;
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
        } elseif ($password !== $confirm_password) {
            $mensaje = "<p class='message error'>¡Las contraseñas no coinciden!</p>";
        } elseif (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
            $mensaje = "<p class='message error'>La contraseña debe tener al menos 8 caracteres, una mayúscula y un número.</p>";
        } else {
            // Realizar verificación de email
            $verificacion = verificarEmail($email);

            if ($verificacion && isset($verificacion['success']) && $verificacion['success']) {
            if (isset($verificacion['result']) && $verificacion['result'] == 'deliverable' && isset($verificacion['disposable']) && !$verificacion['disposable']) {

            $password_hashed = password_hash($password, PASSWORD_BCRYPT);
            $fecha_registro = date('Y-m-d H:i:s'); // <-- Genera la fecha actual

             // Insertar usuario usando prepared statements, ahora con fecha_registro
            $consulta = $conn->prepare("INSERT INTO usuarios (nombre, email, contraseña, fecha_registro) VALUES (?, ?, ?, ?)");
            $consulta->bind_param("ssss", $nombre, $email, $password_hashed, $fecha_registro);
            $resultado = $consulta->execute();

            if ($resultado) {
            $new_user_id = mysqli_insert_id($conn);
            $mensaje = "<p class='message success'>¡Registro exitoso! Redirigiendo...</p>";
            $_SESSION['usuario_id'] = $new_user_id;
            $_SESSION['usuario_nombre'] = $nombre;
            header("Location: ../PHP/index.php");
            exit();
            } else {
            $mensaje = "<p class='message error'>Error al registrar usuario: " . $conn->error . "</p>";
            }
            $consulta->close();
            }    

            // Verificar si la llamada a la API fue exitosa y el resultado es entregable y no desechable
            if ($verificacion && isset($verificacion['success']) && $verificacion['success']) {
                if (isset($verificacion['result']) && $verificacion['result'] == 'deliverable' && isset($verificacion['disposable']) && !$verificacion['disposable']) {

                    $password_hashed = password_hash($password, PASSWORD_BCRYPT);

                    // Insertar usuario usando prepared statements
                    $consulta = $conn->prepare("INSERT INTO usuarios (nombre, email, contraseña) VALUES (?, ?, ?)");
                    $consulta->bind_param("sss", $nombre, $email, $password_hashed);
                    $resultado = $consulta->execute();

                    if ($resultado) {
                        // Obtener el ID del usuario recién insertado
                        $new_user_id = mysqli_insert_id($conn);

                        // Establecer las variables de sesión con el ID y nombre del nuevo usuario
                        $_SESSION['usuario_id'] = $new_user_id;
                        $_SESSION['usuario_nombre'] = $nombre;
                        
                        // *** NUEVA FUNCIONALIDAD: Establecer mensaje de bienvenida ***
                        $_SESSION['mensaje_bienvenida'] = "¡Bienvenido a Digital Mind, " . htmlspecialchars($nombre) . "! Tu cuenta ha sido creada exitosamente.";
                        $_SESSION['mostrar_bienvenida'] = true;

                        // Redirigir al usuario
                        header("Location: ../PHP/index.php");
                        exit();
                    } else {
                        // Error al ejecutar la inserción
                        $mensaje = "<p class='message error'>Error al registrar usuario: " . $conn->error . "</p>";
                    }
                    $consulta->close();

                } else {
                    // Email no válido según Kickbox
                    $reason = $verificacion['reason'] ?? 'Motivo desconocido';
                    $mensaje = "<p class='message error'>Correo no válido: " . htmlspecialchars($reason) . "</p>";
                }
            } elseif ($verificacion && isset($verificacion['message'])) {
                // Error reportado por la función verificarEmail
                $mensaje = "<p class='message error'>Error de verificación: " . htmlspecialchars($verificacion['message']) . "</p>";
            } else {
                // Error general al verificar el correo electrónico
                $mensaje = "<p class='message error'>Error al verificar el correo electrónico.</p>";
            }
        }
        $stmt->close();
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
     <style>
        /* Estilos específicos para el contenedor del campo de contraseña y el icono */
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
            "Invertir en la educacion es invertir en el futuro."
        </blockquote>
    </div>
    <div class="right-panel">
        <form action="../PHP/register.php" method="post">

            <div style="display:flex;justify-content:center;margin-bottom:18px;">
            <img src="../images/Logo_Mk2.png" alt="Logo Digital Mind" style="height:60px;">
            </div>
            <h1>¡Bienvenido a Digital Mind!</h1>
            <p class="subtext">Crea tu cuenta</p>

            <?= $mensaje ?>

            <div class="form-group">
                 <label for="nombre">Nombre de usuario</label>
                 <input type="text" id="nombre" name="nombre" placeholder="Nombre de usuario" required>
            </div>

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

            <div class="form-group">
                 <label for="confirm_password">Confirmar Contraseña</label>
                <div class="show-password">
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmar contraseña" required>
                    <i class="toggle-password" onclick="togglePasswordConfirm()">🔒</i>
                </div>
            </div>

            <button type="submit">Registrate</button>
            <a class="guest-link" href="../PHP/index.php">Ingresar como invitado</a>
            <a class="forgot-link" href="../PHP/recovery.php">¿Olvidaste tu contraseña?</a>

            <p class="switch-auth">¿Ya tienes una cuenta? <a href="login.php">Iniciar sesión</a></p>
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

    function togglePasswordConfirm() {
        const passwordInput = document.getElementById("confirm_password");
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