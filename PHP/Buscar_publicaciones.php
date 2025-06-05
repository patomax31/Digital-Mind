<?php
include 'blog_db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);  // Seguridad: convertimos a entero
    $sql = "SELECT * FROM publicaciones_2 WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        echo "<h1>" . htmlspecialchars($row['titular']) . "</h1>";
        echo "<p><strong>Categoría:</strong> " . htmlspecialchars($row['categoria']) . "</p>";
        echo "<p><strong>Fecha:</strong> " . $row['fecha'] . "</p>";
        echo "<p>" . nl2br(htmlspecialchars($row['contenido'])) . "</p>"; // Supongamos que tienes un campo 'contenido'
    } else {
        echo "<p>No se encontró la noticia.</p>";
    }
} else {
    echo "<p>ID de noticia no especificado.</p>";
}
?>