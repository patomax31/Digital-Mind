<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/search.css">
  <title>Login Usuario</title>
 
</head>
<body>
  <div class="container">
    <div class="left">
      <h2>Tu destino para educación, innovación y crecimiento profesional.</h2>
      <p>"La educación es el arma más poderosa que puedes usar para cambiar el mundo." - Nelson Mandela</p>
    </div>
    <div class="right">
      <h2>¡Bienvenido de nuevo!</h2>
      <form action="verificar_usuario.php" method="POST">
        <div class="form-group">
          <input type="text" name="usuario" placeholder="usuario123 o correo@ejemplo.com" required>
        </div>
        <div class="form-group">
          <input type="password" name="clave" placeholder="Ingresa tu contraseña" required>
        </div>
        <div class="form-options">
          <label><input type="checkbox"> Recordar sesión</label>
          <a href="#">¿Olvidaste tu contraseña?</a>
        </div>
        <button type="submit">Iniciar Sesión</button>
      </form>
      <div class="register">
        ¿No tienes una cuenta? <a href="register.php">Regístrate ahora</a>
      </div>
    </div>
  </div>
</body>
</html>