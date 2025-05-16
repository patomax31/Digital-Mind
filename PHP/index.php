<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DIGITALMIND - Educación y Calidad</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/responsive.css">
  <script src="../Js/responsive.js"></script>
  <script src="../PHP/prueba.js" defer></script>
</head>
<body>
<?php
 include 'header.php';
?>

  <div style="margin-top: 40px;">
    <?php include 'dinamic_carrusel.php'; ?>
  </div>

  <div class="progress-bar">
    <div id="progress" class="progress"></div>
  </div>

  <div class="container">
    <main>
      <div class="most-recent">Más Reciente</div>

      <?php
      include 'blog_db.php';

      // Obtener publicaciones de la base de datos
      $sql = "SELECT * FROM publicaciones_2 ORDER BY fecha_creacion DESC";
      $resultado = $conn->query($sql);

      // Mostrar publicaciones de la base de datos
      if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
          echo '
          <div class="content-item color-noticia-1">
            <div class="content-image">
              <img src="' . (!empty($fila['imagen']) ? '../images/publicaciones/' . htmlspecialchars($fila['imagen']) : '../images/escuela1.jpg') . '" alt="' . htmlspecialchars($fila['titular']) . '">
            </div>
            <div class="content-text">
              <div class="title">' . htmlspecialchars($fila['titular']) . '</div>
              <p>' . htmlspecialchars($fila['descripcion_corta']) . '</p>
              <p class="published">Publicado el ' . date("d/m/Y", strtotime($fila['fecha'])) . '</p>
              <a href="../PHP/post_completo.php?id=' . $fila['id'] . '" class="see-more">Ver más</a>
            </div>
          </div>';
        }
      }

      $conn->close();
      ?>
    </main>
  </div>

  <footer>
    <div class="footer-content">
      <p>Derechos Reservados &reg; Digital-Mind &copy; </p>
    </div>
  </footer>

</body>
</html>