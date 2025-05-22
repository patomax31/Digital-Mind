<?php
session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: ../PHP/login.php");
    exit();
}

include 'blog_db.php';
include 'header.php';

// consulta para los posts
$query = "SELECT * FROM publicaciones_2 ORDER BY fecha DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <link rel="stylesheet" href="../css/admin_panel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <div class="container">
        <h1>Publicaciones</h1>
        <div class="Filtros">
        <a class="crear-publicacion" href="blog_add.php" role="button">Crear nueva publicación</a>
        <button class="filter-button" role="button" id="MostrarPublicado">Publicado</button>
        <button class="filter-button" role="button" id="MostrarArchivado">Archivado</button>
         
        <br><br>

        <div class="content-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Categoría</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['titular']); ?></td>
                            <td><?php echo htmlspecialchars($row['categoria']); ?></td>
                            <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                            <td>
                                <a href="blog_edit.php?id=<?php echo $row['id']; ?>" class="editar">Editar</a>
                                <a href="blog_delete.php?id=<?php echo $row['id']; ?>" class="eliminar">Eliminar</a>
                                <a href="post_completo.php?id=<?php echo $row['id']; ?>" class="ver">Ver</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
