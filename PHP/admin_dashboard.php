<?php
session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: ../PHP/login.php");
    exit();
}

include 'blog_db.php';
include 'header.php';

// Contadores
$usuarios_total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM usuarios"))['total'];
$publicaciones_2_total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM publicaciones_2 WHERE estado = 'publicado'"))['total'];

// publicaciones_2 por categoría (solo las publicadas)
$categorias_resultado = mysqli_query($conn, "
    SELECT c.nombre AS categoria, COUNT(*) as total 
    FROM publicaciones_2 p
    LEFT JOIN categoria c ON p.categoria_id = c.id
    WHERE p.estado = 'publicado'
    GROUP BY c.nombre
");

$categorias = [];
while ($fila = mysqli_fetch_assoc($categorias_resultado)) {
    $categorias[] = $fila;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - DigitalMind</title>
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
    <div class="dashboard-container">
        <header>
            <h1>Panel de Administración</h1>
            <p>Bienvenido, Administrador</p>
        </header>

        <section class="stats-section">
            <div class="card total-users">
                <h3>Usuarios</h3>
                <p><?= $usuarios_total ?></p>
            </div>
            <div class="card total-publicaciones_2">
                <h3>Blogs Publicados</h3>
                <p><?= $publicaciones_2_total ?></p>
            </div>
        </section>

        <section class="category-section">
            <h2>Blogs por Categoría</h2>
            <div class="category-grid">
                <?php foreach ($categorias as $cat): ?>
                    <div class="card category-card">
                        <h4><?= htmlspecialchars($cat['categoria']) ?></h4>
                        <p><?= $cat['total'] ?> blog<?= $cat['total'] != 1 ? 's' : '' ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</body>
</html>
