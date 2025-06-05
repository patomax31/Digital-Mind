<?php
include 'blog_db.php';
include 'header.php';

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de búsqueda</title>
    
    <style>.card-noticia {
    text-decoration: none;
    color: inherit;
}

.card {
    display: flex;
    flex-direction: row;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 20px;
    overflow: hidden;
    transition: transform 0.2s;
}

.card:hover {
    transform: scale(1.01);
}

.card-imagen {
    width: 250px;
    position: relative;
}

.card-imagen img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.categoria {
    position: absolute;
    top: 10px;
    left: 10px;
    background: #f2f2f2;
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 12px;
}

.card-contenido {
    padding: 15px;
    flex-grow: 1;
}

.card-contenido h3 {
    margin: 10px 0;
    font-size: 18px;
    color: #333;
}

.card-contenido p {
    font-size: 14px;
    color: #666;
}

.autor {
    font-size: 12px;
    color: #888;
}

.btn-leer-mas {
    display: inline-block;
    margin-top: 10px;
    padding: 6px 12px;
    background:rgb(240, 240, 240);
    border-radius: 20px;
    font-weight: bold;
    font-size: 13px;
} </style>

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
                echo "<h3><a href='Buscar_publicaciones.php?id=" . $row['id'] . "'>" . htmlspecialchars($row['titular']) . "</a></h3>";
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

<?php
include 'footer.php';
?>
</body>
</html>