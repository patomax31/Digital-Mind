<?php
// Conexión a la base de datos
include 'blog_db.php'; // este archivo debe tener tu conexión a la DB

// Obtener término de búsqueda
if (isset($_GET['q']) && !empty($_GET['q'])) {
    $busqueda = trim($_GET['q']);
    $busqueda = mysqli_real_escape_string($conn, $busqueda); // seguridad

    // Consulta a la base de datos
    $sql = "SELECT * FROM noticias WHERE titulo LIKE '%$busqueda%' OR contenido LIKE '%$busqueda%'";
    $resultado = mysqli_query($conn, $sql);

    echo "<h2>Resultados de búsqueda para: <em>$busqueda</em></h2>";

    if (mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<div class='noticia'>";
            echo "<h3>" . htmlspecialchars($fila['titulo']) . "</h3>";
            echo "<p>" . htmlspecialchars($fila['contenido']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No se encontraron resultados.</p>";
    }

    mysqli_close($conn);
} else {
    echo "<p>Por favor, ingresa un término para buscar.</p>";
}
?>