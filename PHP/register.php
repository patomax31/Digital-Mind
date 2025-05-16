<?php
include("blog_db.php"); // Conexión a la base de datos
$mensaje = "";

// Función para verificar email con Kickbox
function verificarEmail($email) {
    $api_key = 'test_ead774bd4057984fb0ad5d3c4e19944790c6199b579135c5f4a4746e15c65578'; // Reemplaza con tu API Key real
    $url = "https://api.kickbox.com/v2/verify?email=" . urlencode($email) . "&apikey=" . $api_key;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    
    return json_decode($response, true);
}

// Procesar formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        !empty($_POST['nombre']) && 
        !empty($_POST['email']) && 
        !empty($_POST['password']) && 
        !empty($_POST['confirm_password'])
    ) {
        $nombre = trim($_POST['nombre']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);

        // Verificar si el email ya existe en la base de datos
        $consulta_email = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultado_email = mysqli_query($conn, $consulta_email);
        
        if (mysqli_num_rows($resultado_email) > 0) {
            $mensaje = "<h3 class='bad'>¡Este correo electrónico ya está registrado!</h3>";
        } elseif ($password !== $confirm_password) {
            $mensaje = "<h3 class='bad'>¡Las contraseñas no coinciden!</h3>";
        } else {
            // Verificar el email con Kickbox
            $verificacion = verificarEmail($email);
            
            if ($verificacion && $verificacion['success']) {
                // Solo permitir emails verificados como "deliverable"
                if ($verificacion['result'] == 'deliverable' && !$verificacion['disposable']) {
                    $password_hashed = password_hash($password, PASSWORD_BCRYPT);

                    // Inserción de datos en la base de datos
                    $consulta = "INSERT INTO usuarios (nombre, email, contraseña) VALUES ('$nombre', '$email', '$password_hashed')";
                    $resultado = mysqli_query($conn, $consulta);

                    if ($resultado) {
                        $mensaje = "<h3 class='ok'>¡Te has registrado correctamente!</h3>";
                        header("Refresh: 2; url=index.php"); // Redirigir después de 2 segundos
                    } else {
                        $mensaje = "<h3 class='bad'>¡Error al registrarse!</h3>";
                    }
                } else {
                    $razon = $verificacion['reason'] ?? 'correo no válido';
                    $mensaje = "<h3 class='bad'>¡El correo electrónico no es válido! Razón: " . htmlspecialchars($razon) . "</h3>";
                }
            } else {
                $mensaje = "<h3 class='bad'>¡Error al verificar el correo electrónico!</h3>";
            }
        }
    } else {
        $mensaje = "<h3 class='bad'>¡Por favor, complete todos los campos!</h3>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login_style.css">
    <title>Digital Mind - Registro</title>
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
                <h2>Registro</h2>

                <?php echo $mensaje; ?>

                <form action="register.php" method="post">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre..." required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" placeholder="Email..." required>
                        <small class="info">Verificaremos tu dirección de correo electrónico</small>
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" placeholder="Contraseña..." required>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirmar Contraseña:</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmar contraseña..." required>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Registrarse">
                    </div>

                    <div class="form-group">
                        <a href="index.php" class="btn-registrar">Ingresar como invitado</a>
                    </div>

                    <div class="forgot-password">
<<<<<<< HEAD
                        <a href="../PHP/Recuperar contraseña.php">¿Olvidaste tu contraseña?</a>
=======
                        <a href="Recuperar contraseña">¿Olvidaste tu contraseña?</a>
>>>>>>> 347affd (Recuperar contraseña)
                    </div>

                    <p class="footer-text">&copy; Página desarrollada por DigitalMind</p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>