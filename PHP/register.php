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

        // Usar prepared statements para prevenir inyección SQL
        $consulta_email = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        $consulta_email->bind_param("s", $email);
        $consulta_email->execute();
        $resultado_email = $consulta_email->get_result();


        if ($resultado_email->num_rows > 0) {
            $mensaje = "<p class='message error'>¡Este correo ya está registrado!</p>";
        } elseif ($password !== $confirm_password) {
            $mensaje = "<p class='message error'>¡Las contraseñas no coinciden!</p>";
        } elseif (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
            $mensaje = "<p class='message error'>La contraseña debe tener al menos 8 caracteres, una mayúscula y un número.</p>";
        }
        else {
            // Realizar verificación de email
            $verificacion = verificarEmail($email);

            // Verificar si la llamada a la API fue exitosa y el resultado es entregable y no desechable
            if ($verificacion && isset($verificacion['success']) && $verificacion['success']) {
                if (isset($verificacion['result']) && $verificacion['result'] == 'deliverable' && isset($verificacion['disposable']) && !$verificacion['disposable']) {

                    $password_hashed = password_hash($password, PASSWORD_BCRYPT);

                    // Insertar usuario usando prepared statements
                    $consulta = $conn->prepare("INSERT INTO usuarios (nombre, email, contraseña) VALUES (?, ?, ?)");
                    $consulta->bind_param("sss", $nombre, $email, $password_hashed);
                    $resultado = $consulta->execute(); // $resultado será true/false

                    if ($resultado) {
                        // *** CORRECCIÓN AQUÍ ***
                        // Obtener el ID del usuario recién insertado
                        $new_user_id = mysqli_insert_id($conn);

                        $mensaje = "<p class='message success'>¡Registro exitoso! Redirigiendo...</p>";
                        // Establecer las variables de sesión con el ID y nombre del nuevo usuario
                        $_SESSION['usuario_id'] = $new_user_id;
                        $_SESSION['usuario_nombre'] = $nombre; // Usar la variable $nombre del formulario

                        // Redirigir al usuario
                        header("Location: ../PHP/index.php"); // Asegúrate de que esta ruta sea correcta
                        exit();
                    } else {
                        // Error al ejecutar la inserción
                        $mensaje = "<p class='message error'>Error al registrar usuario: " . $conn->error . "</p>";
                    }
                     $consulta->close(); // Cerrar el statement de inserción

                } else {
                    // Email no válido según Kickbox
                    $reason = $verificacion['reason'] ?? 'Motivo desconocido';
                    $mensaje = "<p class='message error'>Correo no válido: " . htmlspecialchars($reason) . "</p>";
                }
            } elseif ($verificacion && isset($verificacion['message'])) {
                 // Error reportado por la función verificarEmail (ej. error de API)
                 $mensaje = "<p class='message error'>Error de verificación: " . htmlspecialchars($verificacion['message']) . "</p>";
            }
            else {
                // Error general al verificar el correo electrónico (ej. $verificacion es null o no tiene 'success')
                $mensaje = "<p class='message error'>Error al verificar el correo electrónico.</p>";
            }
        }
         $consulta_email->close(); // Cerrar el statement de verificación de email
    } else {
        $mensaje = "<p class='message error'>Completa todos los campos.</p>";
    }
}
// La conexión $conn se cierra al final del script o cuando la página termina de cargar
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
             box-sizing: border-box; /* Incluye padding y borde en el ancho */
        }

        /* Estilos para los form-group (copiados de tu CSS) */
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

         /* Estilo para los inputs generales (puedes tener esto en login_style.css) */
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%; /* Ocupa todo el ancho del contenedor */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Incluye padding y borde en el ancho */
            font-size: 1em;
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
        <form action="register.php" method="post">
            <h1>¡Bienvenido a Digital Mind!</h1>
            <p class="subtext">Crea tu cuenta</p>

            <?= $mensaje ?>

            <!-- Envuelto en form-group -->
            <div class="form-group">
                 <label for="nombre">Nombre de usuario</label>
                 <input type="text" id="nombre" name="nombre" placeholder="Nombre de usuario" required>
            </div>

            <!-- Envuelto en form-group -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>

            <!-- Campo de Contraseña con icono, envuelto en form-group -->
            <div class="form-group">
                 <label for="password">Contraseña</label>
                <div class="show-password">
                    <input type="password" id="password" name="password" placeholder="Contraseña" required>
                     <!-- Icono inicial de candado cerrado -->
                    <i class="toggle-password" onclick="togglePassword()">🔒</i>
                </div>
            </div>

             <!-- Campo de Confirmar Contraseña con icono, envuelto en form-group -->
            <div class="form-group">
                 <label for="confirm_password">Confirmar Contraseña</label>
                <div class="show-password">
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmar contraseña" required>
                     <!-- Icono inicial de candado cerrado -->
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
    // Función para mostrar/ocultar contraseña (campo Contraseña)
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const toggleIcon = passwordInput.nextElementSibling; // Selecciona el icono siguiente al input

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.textContent = "🔓"; // Cambia a candado abierto
        } else {
            passwordInput.type = "password";
            toggleIcon.textContent = "🔒"; // Cambia a candado cerrado
        }
    }

     // Función para mostrar/ocultar contraseña (campo Confirmar Contraseña)
    function togglePasswordConfirm() {
        const passwordInput = document.getElementById("confirm_password");
        const toggleIcon = passwordInput.nextElementSibling; // Selecciona el icono siguiente al input

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.textContent = "🔓"; // Cambia a candado abierto
        } else {
            passwordInput.type = "password";
            toggleIcon.textContent = "🔒"; // Cambia a candado cerrado
        }
    }
</script>
</body>
</html>
