<?php
include 'blog_db.php'; 

$sql = "SELECT * FROM publicaciones_2 ORDER BY fecha_creacion DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicaciones</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" type="image/png" href="../images/logo_web.png">
</head>
<body>
    <h2>Lista de Publicaciones</h2>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="post">
            <h3><?= htmlspecialchars($row["titular"]) ?></h3>
            <p><strong>Fecha:</strong> <?= $row["fecha"] ?></p>
            <p><?= htmlspecialchars($row["descripcion_corta"]) ?></p>
            <a href = "../PHP/post_completo.php?id=' . $row['id'] . ' class = " see-more >Ver más</a>
        </div>
        <hr>
        <a href="index.php" class="see-more">Volver a la Pagina Principal</a>
        <div>

        </div>
    <?php endwhile; ?>

    <?php $conn->close(); ?>
</body>
</html>
