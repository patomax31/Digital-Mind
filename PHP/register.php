<?php
include("con_db.php"); // Conexión a la base de datos
$mensaje = "";

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

        if ($password === $confirm_password) {
            $password_hashed = password_hash($password, PASSWORD_BCRYPT);

            // Inserción de datos en la base de datos
            $consulta = "INSERT INTO usuarios (id, nombre, email, contraseña) VALUES ('id', '$nombre', '$email', '$password_hashed')";
            $resultado = mysqli_query($conex, $consulta);

            if ($resultado) {
                $mensaje = "<h3 class='ok'>¡Te has registrado correctamente!</h3>";
            } else {
                $mensaje = "<h3 class='bad'>¡Error al registrarse!</h3>";
            }
        } else {
            $mensaje = "<h3 class='bad'>¡Las contraseñas no coinciden!</h3>";
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
                        <input type="submit" value="Registrarse" href ="main_page.html">
                    </div>

                    <div class="form-group">
                        <a href="main_page.html" class="btn-registrar">Ingresar como invitado</a>
                    </div>

                    <div class="forgot-password">
                        <a href="#">¿Olvidaste tu contraseña?</a>
                    </div>

                    <p class="footer-text">&copy; Página desarrollada por DigitalMind</p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
