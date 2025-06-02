<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - Digital Mind</title>
    <link rel="stylesheet" href="../css/login_style.css">
    <style>
        .ok { color: green; margin-top: 10px; }
        .bad { color: red; margin-top: 10px; }
        .info { color: #555; font-size: 0.9em; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Lado izquierdo con mensaje o imagen -->
        <div class="left-panel">
            <blockquote>
                “La educación es el arma más poderosa para cambiar el mundo.”
            </blockquote>
        </div>

        <!-- Lado derecho con el formulario -->
        <div class="right-panel">
            <form action="/digital-mind/PHP/recuperarContrasena.php" method="post">
                <h1>Recuperar Contraseña</h1>
                <p class="subtext">Ingrese su correo electrónico</p>

                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" placeholder="Email..." required>
                    <small class="info">Te enviaremos instrucciones para recuperar tu cuenta</small>
                </div>

                <button type="submit">Enviar</button>

                <a class="guest-link" href="index.php">Volver al inicio</a>

                <p class="footer-text">&copy; Página desarrollada por Digital Mind</p>
            </form>
        </div>
    </div>
</body>
</html>
