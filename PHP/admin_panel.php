<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: ../PHP/login.php");
    exit();
}

include 'blog_db.php';
include 'header.php';

// Verificar si el usuario es admin


// Agregar cuando los roles esten imp
// if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'editor')) {
//     // Redirigir a la página principal con un mensaje de error
//     $_SESSION['error'] = "No tienes permisos para acceder a esta sección.";
//     header('Location: ../index.php');
//     exit();
// }


// Procesar eliminación
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $stmt = $conn->prepare("DELETE FROM publicaciones_2 WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header('Location: admin_panel.php?success=1');
    exit();
}

// Obtener publicaciones
$sql = "SELECT * FROM publicaciones_2 ORDER BY fecha_creacion DESC";
$result = $conn->query($sql);

// Eliminar comentario del formulario de contacto
if (isset($_GET['eliminar_contacto'])) {
    $id_contacto = intval($_GET['eliminar_contacto']);
    $stmt = $conn->prepare("DELETE FROM contacto WHERE id = ?");
    $stmt->bind_param("i", $id_contacto);
    $stmt->execute();
    header('Location: admin_panel.php?success=1');
    exit();
}


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
                <a href="crud.php" class="btn dashboard-btn"><i class="fas fa-chart-bar"></i> Ver crud</a>
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
                <!-- Nueva sección: Mensajes del formulario de contacto -->
        <h2>Mensajes de Contacto</h2>
       
<?php
$contacto_result = $conn->query("SELECT * FROM contacto ORDER BY id DESC");
?>

<?php if ($contacto_result->num_rows > 0): ?>
    <?php while ($coment = $contacto_result->fetch_assoc()): ?>
        <div class="post">
            <div class="post-actions">
                <a href="admin_panel.php?eliminar_contacto=<?= $coment['id'] ?>" class="btn btn-delete">
                    <i class="fas fa-trash"></i> Eliminar
                </a>
            </div>
            <p><strong>Nombre:</strong> <?= htmlspecialchars($coment["nombre"]) ?> <?= htmlspecialchars($coment["apellido"]) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($coment["email"]) ?></p>
            <p><strong>Mensaje:</strong><br><?= nl2br(htmlspecialchars($coment["mensaje"])) ?></p>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No hay mensajes desde el formulario de contacto.</p>
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

<h2>Publicaciones</h2>

<?php if ($result->num_rows > 0): ?>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Fecha</th>
                <th>Categoría</th>
                <th>Autor</th>
                <th>Descripción corta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                    <p><strong>ID:</strong> <?= $row["id"] ?></p>
                <td><?= htmlspecialchars($row['titular']) ?></td>
                <td><?= $row['fecha'] ?></td>
                <td><?= htmlspecialchars($row['categoria']) ?></td>
                <td><?= htmlspecialchars(string: $row['autor'] ?? 'Admin') ?></td>
                <td><?= htmlspecialchars($row['descripcion_corta']) ?></td>
                <td>
                    <a href="blog_edit.php?id=<?= $row['id'] ?>">Editar</a> |
                    <a href="admin_panel.php?eliminar=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar publicación?')">Eliminar</a> |
                    <a href="../PHP/post_completo.php?id=<?= $row['id'] ?>" target="_blank">Ver</a>
                </td>
            </tr>
            
        <?php endwhile; 
        ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No hay publicaciones aún.</p>
    
<?php endif; ?>

<h2>Mensajes de Contacto</h2>

<?php if ($contacto_result->num_rows > 0): ?>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Mensaje</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($coment = $contacto_result->fetch_assoc()): ?>
            <tr>
                <td><?= $coment['id'] ?></td>
                <td><?= htmlspecialchars($coment['nombre']) . ' ' . htmlspecialchars($coment['apellido']) ?></td>
                <td><?= htmlspecialchars($coment['email']) ?></td>
                <td><?= nl2br(htmlspecialchars($coment['mensaje'])) ?></td>
                <td>
                    <a href="admin_panel.php?eliminar_contacto=<?= $coment['id'] ?>" onclick="return confirm('¿Eliminar mensaje?')">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No hay mensajes desde el formulario de contacto.</p>
<?php endif; ?>
