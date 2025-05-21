<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <title>DIGITALMIND - Educación y Calidad</title>
  <link rel="stylesheet" href="../css/style.css">
  <!-- Mover los scripts al final del body para asegurar que los elementos HTML existan -->
  <!-- <script src="../PHP/prueba.js" defer></script> -->
  <!-- REMOVED: <script src="../Js/scroll.js" defer></script> -->

  <?php include 'dashboard.php'; ?>
  <?php include 'header.php'; ?>
  


 <button id="scrollToTopBtn" class="scroll-top-btn" aria-label="Volver arriba">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
      <path fill-rule="evenodd" d="M11.47 2.47a.75.75 0 011.06 0l7.5 7.5a.75.75 0 11-1.06 1.06l-6.22-6.22V21a.75.75 0 01-1.5 0V4.81l-6.22 6.22a.75.75 0 11-1.06-1.06l7.5-7.5z" clip-rule="evenodd" />
    </svg>
  </button>
  <div style="margin-top: 40px;">
    <?php include 'dinamic_carrusel.php'; ?>
  </div>


  <div class="container">
    <main>
      <div class="most-recent">Más Reciente</div>

      <?php
include 'blog_db.php';  // Incluye la conexión

      // Obtener publicaciones de la base de datos con la nueva conexión
      $sql = "SELECT * FROM publicaciones_2 ORDER BY fecha_creacion DESC";
      $resultado = $conn->query($sql);

      // Mostrar publicaciones de la base de datos
      if ($resultado && $resultado->num_rows > 0) {
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
      } else {
        echo '<p>No hay publicaciones disponibles.</p>';
      }

      // Ahora cerramos la conexión después de usarla por última vez
      $conn->close();
      ?>
    </main>
  </div>

  <footer>
    <div class="footer-content">
      <p>Derechos Reservados &reg; Digital-Mind &copy; </p>
    </div>
  </footer>

<!-- Mover los scripts al final del body -->
<script src="../PHP/prueba.js" defer></script>
<!-- Keep the inline script for scrollBtn -->
<button id="scrollBtn" aria-label="Volver arriba">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
    <path fill-rule="evenodd" d="M11.47 2.47a.75.75 0 011.06 0l7.5 7.5a.75.75 0 11-1.06 1.06l-6.22-6.22V21a.75.75 0 01-1.5 0V4.81l-6.22 6.22a.75.75 0 11-1.06-1.06l7.5-7.5z" clip-rule="evenodd" />
  </svg>
</button>

<!-- Mover el script inline de scrollBtn aquí, después del botón -->
<script>
  // Botón de scroll hacia arriba
  const scrollBtn = document.getElementById('scrollBtn');

  // Verificar si el elemento existe antes de añadir el listener
  if (scrollBtn) {
      window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
          scrollBtn.classList.add('visible');
        } else {
          scrollBtn.classList.remove('visible');
        }
      });

      scrollBtn.addEventListener('click', () => {
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      });
  } else {
      console.error("Element with ID 'scrollBtn' not found.");
  }
</script>

<!-- Corregir la ruta del script de traducción -->
<script src="./translate.js"></script>


</body>
</html>
