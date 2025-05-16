<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login_style.css">
    <title>Recuperar Contraseña - Digital Mind</title>
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
                <h2>Recuperar Contraseña</h2>
                <p>Ingrese su correo electrónico para recibir instrucciones de recuperación.</p>

                <form action="/digital-mind/PHP/recuperarContrasena.php" method="post">
                    <div class="form-group">
                        <label  for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" placeholder="Email..." required>
                        <small class="info">Ingrese su correo para recibir instrucciones de recuperación</small>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Enviar">
                    </div>

                    <div class="forgot-password">
                        <a href="index.php">Volver al inicio</a>
                    </div>

                    <p class="footer-text">&copy; Página desarrollada por Digital Mind</p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>