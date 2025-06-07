<?php
session_start();
include 'blog_db.php';
include 'header.php';
include 'dashboard.php';

$categoria_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($categoria_id < 0) {
    die("Categoría no especificada.");
}

// Obtener nombre de la categoría
$sql_cat = "SELECT nombre FROM categoria WHERE id = $categoria_id";
$res_cat = $conn->query($sql_cat);
if ($res_cat->num_rows === 0) {
    die("Categoría no encontrada.");
}
$row_cat = $res_cat->fetch_assoc();
$sql_cat = "SELECT nombre, descripcion_corta, imagen FROM categoria WHERE id = $categoria_id";
$res_cat = $conn->query($sql_cat);

$row_cat = $res_cat->fetch_assoc();
$tituloCategoria = $row_cat['nombre'];
$descripcionCategoria = $row_cat['descripcion_corta'];
$imagenCategoria = $row_cat['imagen'];
$tituloCategoria = $row_cat['nombre'];

// Obtener publicaciones de la categoría
// Obtener publicaciones públicas de la categoría
$sql = "SELECT * FROM publicaciones_2 WHERE categoria_id = $categoria_id AND estado = 'publicado' ORDER BY fecha DESC";
$resultado = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?php echo $tituloCategoria; ?> | DIGITALMIND</title>
  <link rel="stylesheet" href="../css/style.css">
  <style>
    body {
      padding-top: 80px; /* Ajusta este valor a la altura real de tu header */
    }

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
      text-shadow: 2px 2px 4px #fff;
    }

    .categoria-content {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 25px;
      padding: 30px;
    }

    .blog-card {
      background: linear-gradient(145deg, #ffffff, #e6f2f2);
      border-radius: 16px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      padding: 15px;
      border: 1px solid #c1dcdc;
    }

    .blog-card:hover {
      transform: translateY(-8px) scale(1.03);
      box-shadow: 0 16px 40px rgba(0, 0, 0, 0.2);
      border-color: #7ec8c9;
    }

    .blog-card img {
      width: 140px;
      height: 210px;
      object-fit: cover;
      border-radius: 16px;
      margin-bottom: 14px;
      box-shadow:
        0 0 8px rgba(126, 200, 201, 0.7),
        0 4px 12px rgba(0, 0, 0, 0.1);
      border: 4px solid #7ec8c9;
      transition: box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .blog-card img:hover {
      box-shadow:
        0 0 20px rgba(126, 200, 201, 0.9),
        0 8px 24px rgba(0, 0, 0, 0.18);
      border-color: #4aa0a2;
    }

    .blog-card h2 {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      font-weight: 700;
      font-size: 1.2em;
      color: #1a1a1a;
      margin-bottom: 6px;
    }

    .blog-card p {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #555;
      font-size: 0.9em;
      margin-bottom: 10px;
      background: rgba(255, 255, 255, 0.85);
      padding: 8px 12px;
      border-radius: 12px;
      box-shadow: inset 0 0 8px rgba(0,0,0,0.05);
    }

    .blog-card .fecha {
      font-size: 0.8em;
      color: #888;
      margin-bottom: 12px;
      font-style: italic;
    }

    .ver-mas {
      background-color: #007BFF;
      color: white;
      border: none;
      padding: 10px 22px;
      border-radius: 12px;
      cursor: pointer;
      font-weight: 700;
      text-decoration: none;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      box-shadow: 0 4px 12px rgba(0,123,255,0.4);
      font-size: 0.9em;
    }

    .ver-mas:hover {
      background-color: #0056b3;
      box-shadow: 0 6px 20px rgba(0,86,179,0.6);
    }

    .ver-mas::after {
      content: "→";
      font-weight: 900;
      font-size: 1.2em;
    }
  </style>
</head>
<body>

  <div class="categoria-banner">
    <?php if (!empty($imagenCategoria)): ?>
      <img src="../IMG/<?= htmlspecialchars($imagenCategoria) ?>" alt="Imagen de la categoría" style="width:80px;height:80px;object-fit:cover;border-radius:50%;margin-bottom:10px;">
    <?php endif; ?>
    <h1><?php echo $tituloCategoria; ?></h1>
    <?php if (!empty($descripcionCategoria)): ?>
      <p style="color:#444;"><?= htmlspecialchars($descripcionCategoria) ?></p>
    <?php endif; ?>
  </div>

  <div class="categoria-content">
    <?php if ($resultado->num_rows > 0): ?>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
          <div class="blog-card">
            <?php if (!empty($fila['imagen'])): ?>
              <img src="IMG/<?php echo htmlspecialchars($fila['imagen']); ?>" alt="Imagen del post">
            <?php endif; ?>
            <h2><?php echo htmlspecialchars($fila['titular']); ?></h2>
            <p><?php echo htmlspecialchars($fila['descripcion_corta']); ?></p>
            <div class="fecha">Publicado el <?php echo date('d/m/Y', strtotime($fila['fecha'])); ?></div>
            <a class="ver-mas" href="post_completo.php?id=<?php echo $fila['id']; ?>">Ver más</a>
          </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align:center;">No hay publicaciones en esta categoría.</p>
    <?php endif; ?>
  </div>

</body>
</html>

<?php
include 'footer.php';
$conn->close();
?>
