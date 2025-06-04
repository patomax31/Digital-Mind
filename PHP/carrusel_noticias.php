<?php
// Conexión a la base de datos
include 'blog_db.php';

// Consulta para obtener solo las 5 noticias más recientes
$sql = "SELECT * FROM publicaciones_2 WHERE estado = 'publicado' ORDER BY fecha_creacion DESC LIMIT 5";
$resultado = $conn->query($sql);

if ($resultado && $resultado->num_rows > 0) {
    $noticias = [];
    while ($fila = $resultado->fetch_assoc()) {
        $noticias[] = $fila;
    }
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Artículos Destacados</title>
        <link rel="stylesheet" href="../css/carrusel noticias.css">
    </head>
    <body>
        <div class="news-carousel-container">
            <div class="carousel-section-header">
                <h2>Artículos Recientes</h2>
                <div class="carousel-underline"></div>
            </div>
            <div class="carousel-main-container">
                <div class="carousel-wrapper">
                    <div class="carousel-track" id="carouselTrack">
                        <?php foreach ($noticias as $fila):
                            $titular = htmlspecialchars($fila['titular'] ?? 'Sin título');
                            $autor = htmlspecialchars($fila['autor'] ?? 'Autor desconocido');
                            $fecha = isset($fila['fecha_creacion']) ? date('d/m/Y', strtotime($fila['fecha_creacion'])) : '';
                            $descripcion = htmlspecialchars($fila['descripcion_corta'] ?? 'Sin descripción disponible');
                            $imagen = isset($fila['imagen']) ? '../images/publicaciones/' . htmlspecialchars($fila['imagen']) : '../images/default-news.jpg';
                            $id = $fila['id'] ?? 0;
                        ?>
                        <div class="carousel-article-card">
                            <div class="carousel-card-image">
                                <img src="<?= $imagen ?>" alt="<?= $titular ?>" onerror="this.src='../images/default-news.jpg'">
                            </div>
                            <div class="carousel-card-content">
                                <h3 class="carousel-card-title"><?= $titular ?></h3>
                                <div class="carousel-card-meta">
                                    <div class="carousel-meta-item">
                                        <span class="carousel-meta-icon">👤</span><span><?= $autor ?></span>
                                    </div>
                                    <div class="carousel-meta-item">
                                        <span class="carousel-meta-icon">📅</span><span><?= $fecha ?></span>
                                    </div>
                                </div>
                                <p class="carousel-card-description"><?= $descripcion ?></p>
                                <a href="../PHP/post_completo.php?id=<?= $id ?>" class="carousel-read-more-btn">Leer más</a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php if (count($noticias) > 1): ?>
                    <div class="carousel-indicators">
                        <?php for ($i = 0; $i < count($noticias); $i++): ?>
                            <div class="carousel-indicator <?= $i === 0 ? 'active' : '' ?>" data-position="<?= $i ?>"></div>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
                <div class="carousel-swipe-hint">
                    <span>← Desliza para ver más →</span>
                </div>
            </div>
        </div>
        <script src="../Js/carrusel noticias.js"></script>
    </body>
    </html>
    <?php
} else {
    echo '<div class="carousel-no-news"><p>No hay noticias disponibles en este momento.</p></div>';
}
$conn->close();
?>