<?php
include 'blog_db.php';

if (isset($_GET["id"])){
    $id = $_GET["id"];
    $stmt = $conn->prepare("SELECT * FROM publicaciones_2 WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();
} else{
    die("Publicacion no encontrada");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($post["titular"]) ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2><?= htmlspecialchars($post["titular"]) ?></h2>
    <p><strong>Fecha:</strong> <?= $post["fecha"] ?></p>
    <p><strong>Descripción:</strong> <?= htmlspecialchars($post["descripcion_corta"]) ?></p>
    <p><strong>Contenido:</strong> <?= nl2br(htmlspecialchars($post["contenido"])) ?></p>

    <?php if (!empty($post["referencia"])): ?>
        <p><strong>Referencia:</strong> <a href="<?= htmlspecialchars($post["referencia"]) ?>" target="_blank">Ver fuente</a></p>
    <?php endif; ?>

    <a href="publicaciones.php">Volver</a>
</body>
</html>

<?php $stmt->close(); $conn->close(); ?>