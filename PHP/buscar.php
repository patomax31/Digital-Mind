<?php

include 'blog_db.php'; // tu conexión a BD

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($q === '') {
  echo "<p>Por favor, ingresa un término para buscar.</p>";
  exit;
}

// Sanitizar para evitar SQL injection
$q_safe = mysqli_real_escape_string($conn, $q);

// Buscar en noticias y categorías (ajusta nombres)
$sql = "SELECT * FROM publicaciones_2 WHERE titular LIKE '%$q_safe%' OR categoria LIKE '%$q_safe%' ORDER BY fecha DESC";

$result = mysqli_query($conn, $sql);
if (!$result) {
  die("Error en la consulta: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
  echo "<h2>Resultados para '" . htmlspecialchars($q) . "':</h2><ul>";
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<li><a href='publicaciones_2.php?id=" . $row['id'] . "'>" . htmlspecialchars($row['titular']) . "</a> - Categoría: " . htmlspecialchars($row['categoria']) . "</li>";
  }
  echo "</ul>";
} else {
  echo "<p>No se encontraron resultados para '" . htmlspecialchars($q) . "'.</p>";
}
?>