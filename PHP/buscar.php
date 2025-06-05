<?php
include 'blog_db.php';

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de búsqueda</title>
    <link rel="stylesheet" href="../css/Pagina_resultado.css">
</head>
<body>

<div class="contenedor-busqueda">
    <?php
    if ($q === '') {
        echo "<p class='mensaje-error'>Por favor, ingresa un término para buscar.</p>";
    } else {
        // Sanitizar para evitar SQL injection
        $q_safe = mysqli_real_escape_string($conn, $q);

        // Consulta
        $sql = "SELECT * FROM publicaciones_2 WHERE titular LIKE '%$q_safe%' OR categoria LIKE '%$q_safe%' ORDER BY fecha DESC";
        $result = mysqli_query($conn, $sql);

        echo "<h2 class='titulo-resultados'>Resultados para: <strong>" . htmlspecialchars($q) . "</strong></h2>";

        if ($result && mysqli_num_rows($result) > 0) {
            echo "<div class='lista-resultados'>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='card-noticia'>";
                echo "<h3><a href='publicaciones.php?id=" . $row['id'] . "'>" . htmlspecialchars($row['titular']) . "</a></h3>";
                echo "<p><strong>Categoría:</strong> " . htmlspecialchars($row['categoria']) . "</p>";
                echo "<p><strong>Fecha:</strong> " . $row['fecha'] . "</p>";
                echo "<a class='btn-leer-mas' href='publicaciones.php?id=" . $row['id'] . "'>Leer más</a>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<p class='mensaje-error'>No se encontraron resultados para '" . htmlspecialchars($q) . "'.</p>";
        }
    }
    ?>
</div>

</body>
</html>