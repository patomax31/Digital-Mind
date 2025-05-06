<?php

include 'blog_db.php';
$id_seccion = $_GET['id_seccion'];

$resultado = $conn->query("SELECT * FROM publicaciones_cat WHERE id_seccion ORDER BY fecha DESC");

while ($pub = $resultado->fetch_assoc()) {
    echo 
   ' <div class="content-item">
        <div class="content-text">
            <div class="title">' . htmlspecialchars($pub['titulo']) . '</div>
            <p>' . htmlspecialchars($pub['descripcion_corta']) . '</p>
            <p class="published">Publicado el ' . date("d/m/Y", strtotime($pub['fecha'])) . '</p>
            <a href="post_completo.php?id=' . $pub['id'] . '" class="see-more">Ver más</a>
        </div>
    </div>';

}

?>