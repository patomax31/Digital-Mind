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
  <link rel="stylesheet" href="../css/search.css">
  <script src="../Js/responsive.js"></script>
  <?php include 'dashboard.php'; ?>
 
</head>
<body>
  <header class="page-header-footer sliding-header" id="slidingHeader">
    <div class="page-container">
      <div class="header-left">

        <div class="logo">
          <a href="index.php">
            <img src="../images/Logo_Mk2.png" alt="Logo de DIGITALMIND">
          </a>
        </div>
        <div class="header-actions-left">
          <div class="action-container">
            <svg class="create-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
              <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
            </svg>
            <a href="blog_add.php">Crear Blog</a>
          </div>
          <div class="action-container">
            <svg class="category-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 0 0-3 3v4.318a3 3 0 0 0 .879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 0 0 5.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 0 0-2.122-.879H5.25ZM6.375 7.5a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25Z" clip-rule="evenodd" />
            </svg>
            <a href="#">Categoría</a>
          </div>
        </div>
      </div>

      <div class="header-right">
        <div class="action-container">
          <svg class="Login-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
          </svg>
          <a href="../PHP/register.php">Iniciar sesión</a>
        </div>
        <div class="pill-search">
          <div class="search-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
              <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z" clip-rule="evenodd" />
            </svg>
          </div>
          <input type="text" class="search-input" placeholder="Buscar...">
        </div>
      </div>
    </div>
  </header>

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