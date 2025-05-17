<?php
// Procesamiento del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $host = "localhost";
  $usuario = "root";
  $contrasena = "";
  $base_datos = "blog_db"; // ← CAMBIA este valor al nombre real de tu base de datos

  $conn = new mysqli($host, $usuario, $contrasena, $base_datos);

  if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
  }

  $nombre   = $_POST['nombre'] ?? '';
  $apellido = $_POST['apellido'] ?? '';
  $email    = $_POST['email'] ?? '';
  $mensaje  = $_POST['mensaje'] ?? '';

  if (!empty($nombre) && !empty($apellido) && !empty($email) && !empty($mensaje) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $stmt = $conn->prepare("INSERT INTO contacto (nombre, apellido, email, mensaje) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $apellido, $email, $mensaje);

    if ($stmt->execute()) {
      echo "<script>alert('Mensaje enviado correctamente.');</script>";
    } else {
      echo "<script>alert('Error al enviar el mensaje: " . $stmt->error . "');</script>";
    }

    $stmt->close();
  } else {
    echo "<script>alert('Por favor, completa todos los campos correctamente.');</script>";
  }

  $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Contacto</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      background: linear-gradient(to bottom, #c9e6f3, #e3f2f7);
      padding: 0;
    }

    header {
      text-align: center;
      padding: 60px 30px 20px;
      background-color:rgb(159, 182, 184);
    }

    header h1 {
      font-size: 36px;
      color: #003B6F;
      text-decoration: underline;
    }

    .social-icons {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-top: 20px;
    }

    .social-icons i {
      font-size: 28px;
      background-color: #000;
      color: white;
      padding: 10px;
      border-radius: 50%;
    }

    .contact-info {
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: center;
      gap: 100px;
      margin: 30px 0;
    }

    .info-box {
      background-color: #5E8092;
      color: white;
      padding: 25px 55px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      gap: 15px;
      font-size: 16px;
    }

    .info-box i {
      font-size: 20px;
    }

    .contact-info .img {
      max-width: 200px;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .contact-section {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
      padding: 40px 20px;
    }

    .glass-form {
      background: rgba(255, 255, 255, 0.2);
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-radius: 20px;
      border: 1px solid rgba(255, 255, 255, 0.3);
      padding: 30px;
      max-width: 500px;
      width: 100%;
    }

    .glass-form h2 {
      margin-top: 0;
      margin-bottom: 20px;
      font-size: 24px;
      color: #003b6f;
    }

    .glass-form .form-group {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .glass-form input,
    .glass-form textarea {
      width: 100%;
      padding: 10px 15px;
      border-radius: 10px;
      border: none;
      margin-top: 15px;
      font-size: 14px;
      background: rgba(255, 255, 255, 0.6);
      box-shadow: inset 0 0 5px rgba(0,0,0,0.05);
    }

    .glass-form .form-group input {
      width: calc(50% - 5px);
    }

    .glass-form button {
      margin-top: 20px;
      padding: 12px 20px;
      background-color: #2563eb;
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .glass-form button:hover {
      background-color: #1d4ed8;
    }

    .map-placeholder {
      width: 400px;
      height: 300px;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    iframe {
      width: 100%;
      height: 100%;
      border: none;
    }

    @media (max-width: 768px) {
      .form-group input {
        width: 100%;
      }
      .contact-section {
        flex-direction: column;
        align-items: center;
      }
      .map-placeholder {
        width: 100%;
        max-width: 500px;
      }
      .contact-info {
        flex-direction: column;
        gap: 20px;
      }
    }
  </style>
</head>
<body>
  <?php include 'header.php'; ?>

  <header>
    <h1>Contactate Con Nosotros</h1>
    <div class="social-icons">
      <i class="fab fa-facebook-f"></i>
      <i class="fab fa-instagram"></i>
      <i class="fab fa-tiktok"></i>
      <i class="fab fa-x-twitter"></i>
    </div>
  </header>

  <div class="contact-info">
    <div>
      <div class="info-box"><i class="fas fa-envelope"></i> XimenitaAlcaraz@gmail.com</div>
      <div class="info-box"><i class="fas fa-phone"></i> +31 412 784 85392</div>
    </div>
    <img src="imagencontact.png" alt="Contact Image">
  </div>

  <div class="contact-section">
    <div class="map-placeholder">
      <iframe src="https://www.google.com/maps/embed?..." allowfullscreen></iframe>
    </div>

    <form class="glass-form" method="POST">
      <h2>Vamos a Enviar Un Mensaje Para Nosotros</h2>
      <div class="form-group">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="apellido" placeholder="Apellido" required>
      </div>
      <input type="email" name="email" placeholder="Email" required>
      <textarea name="mensaje" rows="5" placeholder="Mensaje" required></textarea>
      <button type="submit">Enviar</button>
    </form>
  </div>

  <?php include 'footer.php'; ?>
</body>
</html>
