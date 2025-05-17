<?php
session_start();


include 'blog_db.php';
include 'header.php';

// Verificar si el usuario es admin


// Procesar eliminación
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $stmt = $conn->prepare("DELETE FROM publicaciones_2 WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header('Location: panel_admin.php?success=1');
    exit();
}

// Obtener publicaciones
$sql = "SELECT * FROM publicaciones_2 ORDER BY fecha_creacion DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="../css/admin_panel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Panel de Administración</h1>
            <div class="header-actions">
                <a href="admin_dashboard.php" class="btn dashboard-btn"><i class="fas fa-chart-bar"></i> Ver Dashboard</a>
                <a href="admin_logout.php" class="btn logout-btn"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
            </div>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="success-message">Operación realizada con éxito!</div>
        <?php endif; ?>

        <a href="blog_add.php" class="btn btn-add"><i class="fas fa-plus"></i> Agregar Nueva Publicación</a>

        <h2>Publicaciones</h2>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="post">
                    <div class="post-actions">
                        <a href="blog_edit.php?id=<?= $row['id'] ?>" class="btn btn-edit"><i class="fas fa-edit"></i> Editar</a>
                        <a href="admin_panel.php?eliminar=<?= $row['id'] ?>" class="btn btn-delete"><i class="fas fa-trash"></i> Eliminar</a>
                    </div>

                    <h3><?= htmlspecialchars($row["titular"]) ?></h3>
                    <p><strong>ID:</strong> <?= $row["id"] ?></p>
                    <p><strong>Fecha:</strong> <?= $row["fecha"] ?></p>
                    <p><strong>Categoría:</strong> <?= htmlspecialchars($row["categoria"]) ?></p>
                    <p><strong>Autor:</strong> <?= htmlspecialchars($row["autor"] ?? 'Admin') ?></p>
                    <p><strong>Descripción corta:</strong> <?= htmlspecialchars($row["descripcion_corta"]) ?></p>
                    <a href="../PHP/post_completo.php?id=<?= $row['id'] ?>" class="btn btn-view" target="_blank"><i class="fas fa-eye"></i> Ver en sitio</a>

                    <!-- Mostrar comentarios -->
                    <div class="comments">
                        <h4>Comentarios:</h4>
                        <?php
                            $post_id = $row['id'];
                            $comentarios = mysqli_query($conn, "SELECT * FROM comentarios WHERE id_post = $post_id ORDER BY fecha DESC");
                            if (mysqli_num_rows($comentarios) > 0):
                                while ($comentario = mysqli_fetch_assoc($comentarios)):
                        ?>
                            <div class="comment">
                                <p><strong><?= htmlspecialchars($comentario['nombre']) ?>:</strong> <?= htmlspecialchars($comentario['comentario']) ?></p>
                                <small><?= $comentario['fecha'] ?></small>
                            </div>
                        <?php endwhile; else: ?>
                            <p>No hay comentarios.</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No hay publicaciones aún.</p>
        <?php endif; ?>
    </div>

    <script>
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('¿Estás seguro de eliminar esta publicación?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>

<?php $conn->close(); ?>
