<?php
require_once __DIR__ . "/blog_db.php"; // Conexión a la base de datos

$error = "";
$success = "";

// Procesar la petición POST para actualizar la contraseña
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['token'], $_POST['password'], $_POST['confirm_password'])) {
        die("Error: Datos incompletos.");
    }

    $token = trim($_POST['token']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Verificar que las contraseñas coincidan
    if ($password !== $confirm_password) {
        $error = "Las contraseñas no coinciden.";
    } else {
        // Buscar el usuario por el token y verificar que no haya expirado
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE reset_token = ? AND token_expires >= NOW()");
        if (!$stmt) {
            die("Error en la consulta: " . $conn->error);
        }
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $usuario = $result->fetch_assoc();

            // Encriptar la nueva contraseña
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Actualizar la contraseña y eliminar el token de recuperación
            $update_stmt = $conn->prepare("UPDATE usuarios SET contraseña = ?, reset_token = NULL, token_expires = NULL WHERE id = ?");
            if (!$update_stmt) {
                die("Error en la actualización: " . $conn->error);
            }
            $update_stmt->bind_param("si", $hashedPassword, $usuario['id']);

            if ($update_stmt->execute()) {
                // Mostrar un mensaje de éxito decorado con CSS junto a una palomita de aprobación y redirigir al inicio automáticamente
                ?>
                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <title>Contraseña Restablecida</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f2f2f2;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            height: 100vh;
                            margin: 0;
                        }
                        .container {
                            background-color: #d4edda;
                            border: 1px solid #c3e6cb;
                            padding: 20px;
                            border-radius: 8px;
                            text-align: center;
                            box-shadow: 0 0 10px rgba(0,0,0,0.1);
                        }
                        .check-icon {
                            font-size: 50px;
                            color: #28a745;
                            margin-bottom: 10px;
                        }
                        h2 {
                            margin: 0 0 10px;
                        }
                        p {
                            font-size: 16px;
                        }
                    </style>
                    <script>
                        // Redirigir automáticamente al inicio en 3 segundos
                        setTimeout(function() {
                            window.location.href = "index.php";
                        }, 3000);
                    </script>
                </head>
                <body>
                    <div class="container">
                        <div class="check-icon">&#x2714;</div>
                        <h2>¡Tu contraseña ha sido restaurada!</h2>
                        <p>Serás redirigido al inicio en 3 segundos...</p>
                    </div>
                </body>
                </html>
                <?php
                exit();
            } else {
                $error = "Hubo un problema al actualizar la contraseña.";
            }
        } else {
            $error = "El enlace de recuperación es inválido o ha expirado.";
        }
    }
}

// Si la petición es GET o hubo error en el POST, se muestra el formulario
if ($_SERVER['REQUEST_METHOD'] === 'GET' || (!empty($error) && empty($success))) {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (!isset($_GET['token'])) {
            die("Enlace inválido.");
        }
        $token = trim($_GET['token']);

        // Validar el token en la base de datos
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE reset_token = ? AND token_expires >= NOW()");
        if (!$stmt) {
            die("Error en la consulta: " . $conn->error);
        }
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result || $result->num_rows === 0) {
            die("El enlace de recuperación es inválido o ha expirado.");
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/login_style.css">
        <title>Restablecer Contraseña - Digital Mind</title>
        <style>
            .ok { color: green; }
            .bad { color: red; }
            .info { color: blue; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="image-section"></div>
            <div class="form-section">
                <div class="form-container">
                    <h2>Restablecer Contraseña</h2>
                    <?php
                    if (!empty($error)) {
                        echo "<p class='bad'>" . htmlspecialchars($error) . "</p>";
                    }
                    if (!empty($success)) {
                        echo "<p class='ok'>" . htmlspecialchars($success) . "</p>";
                    }
                    ?>
                    <?php if (empty($success)): ?>
                        <form action="resetPassword.php" method="post">
                            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                            <div class="form-group">
                                <label for="password">Nueva Contraseña:</label>
                                <input type="password" id="password" name="password" placeholder="Nueva contraseña" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirmar Contraseña:</label>
                                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmar contraseña" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Restablecer Contraseña">
                            </div>
                        </form>
                    <?php endif; ?>
                    <div class="forgot-password">
                        <a href="index.php">Volver al inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit();
}
?>