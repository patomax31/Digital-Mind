<?php
include 'blog_db.php';

$categoria = isset($_GET['categoria']) ? $conn->real_escape_string($_GET['categoria']) : '';

if (empty($categoria)) {
    die("Categoría no especificada.");
}

$sql = "SELECT * FROM publicaciones_2 WHERE categoria = '$categoria' ORDER BY fecha DESC";
$resultado = $conn->query($sql);

include 'header.php';
?>

<div class="container">
    <h1>Publicaciones en "<?php echo htmlspecialchars($categoria); ?>"</h1>

    <?php if ($resultado->num_rows > 0): ?>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
            <div class="post">
                <h2><a href="post_completo.php?id=<?php echo $fila['id']; ?>">
                    <?php echo htmlspecialchars($fila['titular']); ?>
                </a></h2>
                <p><?php echo htmlspecialchars($fila['descripcion_corta']); ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay publicaciones en esta categoría.</p>
    <?php endif; ?>
</div>

<?php
include 'footer.php';
$conn->close();
?>
<?php
$categoria = $_GET['categoria'] ?? '';
$tituloCategoria = '';
$colorFondo = '#f5f5f5';

switch ($categoria) {
  case 'educacion_p':
    $tituloCategoria = 'Educación Primaria';
    break;
  case 'educacion_m':
    $tituloCategoria = 'Educación Media';
    break;
  case 'educacion_ms':
    $tituloCategoria = 'Educación Media Superior';
    break;
  case 'educacion_s':
    $tituloCategoria = 'Educación Superior';
    break;
  default:
    $tituloCategoria = 'Categoría no encontrada';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?php echo $tituloCategoria; ?> | DIGITALMIND</title>
  <link rel="stylesheet" href="../css/blog_style_Mk2.css">
  <style>
    .categoria-banner {
      background-color: <?php echo $colorFondo; ?>;
      padding: 40px 20px;
      text-align: center;
      border-bottom: 2px solid #ccc;
    }

    .categoria-banner h1 {
      font-size: 2em;
      color: #333;
      margin: 0;
    }

    .categoria-content {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      padding: 40px;
    }

    .blog-card {
      background-color: white;
      padding: 20px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      border-radius: 10px;
      transition: transform 0.3s ease;
    }

    .blog-card:hover {
      transform: translateY(-5px);
    }

    .blog-card h2 {
      font-size: 1.3em;
      margin-bottom: 10px;
      color: #222;
    }

    .blog-card p {
      color: #555;
      font-size: 0.95em;
    }
  </style>
</head>
<body>

  <div class="categoria-banner">
    <h1><?php echo $tituloCategoria; ?></h1>
  </div>

  <div class="categoria-content">
    <!-- Tarjeta de blog de ejemplo -->
    <div class="blog-card">
      <h2>Esto es un test</h2>
      <p>Contenido de ejemplo para mostrar cómo se ve una entrada en esta categoría.</p>
    </div>

    <div class="blog-card">
      <h2>Otra entrada de prueba</h2>
      <p>Más texto de prueba para mostrar múltiples tarjetas.</p>
    </div>
  </div>

  <footer style="text-align:center; padding: 20px;">
    Derechos Reservados ® Digital-Mind © 2025
  </footer>
</body>
</html>

