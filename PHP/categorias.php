<?php
include 'header.php';
include 'blog_db.php';

$query_categorias = "SELECT * FROM categoria ORDER BY nombre ASC";
$result_categorias = mysqli_query($conn, $query_categorias);
?>
<!DOCTYPE html>
<html lang="es">
<head>
</head>
<body>
<div class="categorias-container">
  <div class="categoria-listado">
    <?php while ($cat = mysqli_fetch_assoc($result_categorias)): ?>
      <div class="categoria-card" onclick="location.href='categoria.php?id=<?= $cat['id'] ?>'">
        <h3><?= htmlspecialchars($cat['nombre']) ?></h3>
        <?php if (!empty($cat['descripcion_corta'])): ?>
          <p style="font-size:0.95em;color:#444;margin:10px 0 0 0;"><?= htmlspecialchars($cat['descripcion_corta']) ?></p>
        <?php endif; ?>
      </div>
    <?php endwhile; ?>
  </div>

  <div class="cta-contacto">
    <h2>¿Tienes dudas o no hayaste lo que buscabas?</h2>
    <a href="contact_page.php">Contáctanos</a>
  </div>
</div>
</body>
</html>
<?php include 'footer.php'; ?>
 <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f9f9;
      margin: 0;
      padding: 0;
      padding-top: 70px;
    }

    .categorias-container {
      max-width: 1100px;
      margin: auto;
      padding: 40px 20px;
    }

    .categoria-listado {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 20px;
    }

    .categoria-card {
      background: white;
      border-radius: 14px;
      padding: 20px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      text-align: center;
      transition: transform 0.2s;
      cursor: pointer;
      border: 1px solid #d6eaea;
    }

    .categoria-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .categoria-card i {
      font-size: 2.5em;
      color: #4aa0a2;
      margin-bottom: 10px;
    }

    .categoria-card h3 {
      margin: 8px 0 4px;
      font-size: 1.2em;
      color: #222;
    }

    .categoria-card span {
      display: block;
      font-size: 0.95em;
      color: #555;
      font-weight: 500;
      margin-bottom: 8px;
    }

    .categoria-card p {
      font-size: 0.88em;
      color: #666;
    }

    .cta-contacto {
      text-align: center;
      margin-top: 50px;
      padding: 30px;
      background-color: #e8f5f5;
      border-radius: 16px;
    }

    .cta-contacto h2 {
      font-size: 1.5em;
      color: #0077cc;
    }

    .cta-contacto a {
      display: inline-block;
      margin-top: 16px;
      padding: 12px 28px;
      background-color: #0077cc;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-weight: 600;
    }

    .cta-contacto a:hover {
      background-color: #005fa3;
    }

    /* Puedes poner esto en tu <style> o en tu CSS principal */
.categoria-card {
  background: #f8fcfc;
  border-radius: 12px;
  padding: 28px 18px 18px 18px;
  box-shadow: 0 2px 8px rgba(74,160,162,0.08);
  text-align: center;
  transition: box-shadow 0.2s, transform 0.2s;
  cursor: pointer;
  border: 1.5px solid #e0f0f0;
  position: relative;
  min-height: 140px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
.categoria-card:hover {
  box-shadow: 0 6px 24px rgba(74,160,162,0.18);
  border-color: #4aa0a2;
  transform: translateY(-4px) scale(1.03);
  background: #eafafa;
}
.categoria-icono {
  margin-bottom: 12px;
}
.categoria-card h3 {
  margin: 0;
  font-size: 1.15em;
  color: #222;
  font-weight: 700;
  letter-spacing: 0.5px;
}
  </style>

  <script src="translate.js"></script>
</html>