<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();


$mensaje = '';
if (isset($_SESSION['mensaje_archivo'])) {
    $mensaje = $_SESSION['mensaje_archivo'];
    unset($_SESSION['mensaje_archivo']);
}

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: ../PHP/login.php");
    exit();
}

include 'blog_db.php';
include 'header.php';
include 'dashboard.php';


if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);

    $stmt = $conn->prepare("DELETE FROM publicaciones_2 WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirigir de vuelta al panel con mensaje
        header("Location: admin_panel.php?mensaje=eliminado");
        exit();
    } else {
        echo "Error al eliminar la publicación.";
    }
}



// Consulta para publicaciones activas (solo publicadas)
$query_posts = "
SELECT 
    p.*, 
    c.nombre AS categoria_nombre 
FROM 
    publicaciones_2 p 
LEFT JOIN 
    categoria c ON p.categoria_id = c.id 
WHERE 
    p.estado = 'publicado' 
ORDER BY 
    p.fecha DESC
";

// Consulta para publicaciones archivadas
$query_archivados = "
SELECT 
    p.*, 
    c.nombre AS categoria_nombre 
FROM 
    publicaciones_2 p 
LEFT JOIN 
    categoria c ON p.categoria_id = c.id 
WHERE 
    p.estado = 'archivado' 
ORDER BY 
    p.fecha DESC
";

$resultado_posts = $conn->query(   $query_posts);
$resultado_archivados = $conn->query($query_archivados);

$result_posts = mysqli_query($conn, $query_posts);
$result_archivados = mysqli_query($conn, $query_archivados);

$query_categorias = "SELECT * FROM categoria ORDER BY nombre ASC";
$result_categorias = mysqli_query($conn, $query_categorias);


$result_posts = mysqli_query($conn, $query_posts);
$result_archivados = mysqli_query($conn, $query_archivados);

// Consultas

/*
$query_categorias = "SELECT * FROM categorias ORDER BY id DESC";
$result_categorias = mysqli_query($conn, $query_categorias);
*/
$query_usuarios = "SELECT * FROM usuarios ORDER BY id DESC";
$result_usuarios = mysqli_query($conn, $query_usuarios);

$query_comentarios = "SELECT * FROM comentarios ORDER BY fecha DESC";
$result_comentarios = mysqli_query($conn, $query_comentarios);

$query_contacto = "SELECT * FROM contacto ORDER BY id DESC";
$result_contacto = mysqli_query($conn, $query_contacto);

$query_admin = "SELECT * FROM admin ORDER BY id DESC";
$result_admin = mysqli_query($conn, $query_admin);


//Procesar eliminacion de blog
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $stmt = $conn->prepare("DELETE FROM publicaciones_2 WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header('Location: crud.php?success=1');
    exit();
}

// Eliminar administrador
if (isset($_GET['eliminar_admin'])) {
    $admin_id = intval($_GET['eliminar_admin']);

    $query = "DELETE FROM usuarios WHERE id = $admin_id AND rol = 'admin'";
    $resultado = mysqli_query($conn, $query);

    if ($resultado) {
        header("Location: crud.php#admin");
        exit;
    } else {
        echo "Error al eliminar el administrador.";
    }
}

// Eliminar usuario
if (isset($_GET['eliminar_usuario'])) {
    $usuario_id = intval($_GET['eliminar_usuario']);

    $query = "DELETE FROM usuarios WHERE id = $usuario_id AND rol != 'admin'";
    $resultado = mysqli_query($conn, $query);

    if ($resultado) {
        header("Location: crud.php#usuarios");
        exit;
    } else {
        echo "Error al eliminar el usuario.";
    }
}


?>

<script>
    //script para la navegacion
    // En tu script existente, añade esto para manejar parámetros URL
document.addEventListener('DOMContentLoaded', function() {
    // Manejar parámetro section en URL
    const urlParams = new URLSearchParams(window.location.search);
    const sectionParam = urlParams.get('section');
    
    if (sectionParam === 'archivados') {
        // Mostrar sección de archivados al cargar
        document.querySelectorAll('.section-content').forEach(section => {
            section.classList.remove('active');
        });
        document.getElementById('archivados').classList.add('active');
    }
    
    // Resto de tu código JavaScript existente...
    
    // Añade funcionalidad para checkboxes en archivados
    const selectAllArchived = document.getElementById('select-all-archived');
    const checkboxesArchived = document.querySelectorAll('.row-checkbox-archived');
    
    if (selectAllArchived) {
        selectAllArchived.addEventListener('change', () => {
            checkboxesArchived.forEach(cb => cb.checked = selectAllArchived.checked);
        });
    }
});
//Busqueda para archivados
// Añade esto a tu JavaScript existente
const searchArchived = document.querySelector('#archivados .search-bar');
if (searchArchived) {
    searchArchived.addEventListener('input', function() {
        const term = this.value.toLowerCase();
        const rows = document.querySelectorAll('#archivados tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(term) ? '' : 'none';
        });
    });
}

</script>




<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../css/crud.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
body {
    padding-top: 100px; /* Igual a la altura de tu header */
}
    </style>
</head>

<?php if (!empty($mensaje)): ?>
<div id="modal-archivado">
    <?= htmlspecialchars($mensaje) ?>
</div>
<?php endif; ?>

<body>
    <h1>Admin Panel</h1>
<div class="nav-button-container">
    <button class="nav-bar-button" role="button" data-section="posts">Posts</button>
    <button class="nav-bar-button" role="button" data-section="categorias">Categorías</button>
    <button class="nav-bar-button" role="button" data-section="usuarios">Usuarios</button>
    <button class="nav-bar-button" role="button" data-section="comentarios">Comentarios</button>
    <button class="nav-bar-button" role="button" data-section="contacto">Contacto</button>
    <button class="nav-bar-button" role="button" data-section="admin">Admin</button>
</div>

<!-- Sección Posts -->
<div id="posts" class="section-content active">
    <h1>Publicaciones</h1>
        <div class="posts-actions">
            <a class="crear-publicacion" href="blog_add.php" role="button">Crear nueva publicación</a>
            <button class="nav-bar-button" role="button" data-section="archivados">Archivados</button>
            <div class="bulk-actions">
                <button id="bulk-archive" disabled>Archivar seleccionados</button>
            </div>
        </div>

<table class="table">
    <thead>
        <tr>
            <th><input type="checkbox" id="select-all-posts"></th>
            <th>#</th>
            <th>Título</th>
            <th>Categoría</th>
            <th>Fecha</th>
            <th>Estrellas</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $counter = 1;
        while ($row = mysqli_fetch_assoc($result_posts)) :
        ?>
            <tr>
                <td><input type="checkbox" class="row-checkbox" data-id="<?= $row['id'] ?>"></td>
                <td><?= $counter ?></td>
                <td><?= htmlspecialchars($row['titular']) ?></td>
                <td><?= htmlspecialchars($row['categoria_nombre'] ?? 'Sin categoría') ?></td>
                <td><?= htmlspecialchars($row['fecha']) ?></td>
                <td><?= htmlspecialchars($row['rating_count'] ?? '0') ?></td>
                <td>
                    <!-- Botón Ver -->
                    <a class="view-button" href="../PHP/post_completo.php?id=<?= $row['id'] ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path fill="currentcolor" d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                        </svg>
                    </a>

                    <!-- Botón Editar -->
                    <a class="edit-button" href="../PHP/blog_edit.php?id=<?= $row['id'] ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentcolor" d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                        </svg>
                    </a>

                    <!-- Botón Eliminar -->
                    <a class="delete-button" href="crud.php?eliminar=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar publicación?')" title="Eliminar artículo">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">                                    
                            <path fill="currentcolor" d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                        </svg>
                    </a>

                    <!-- Botón Archivar/Desarchivar -->
                    <?php if($row['estado'] == 'publicado'): ?>
                        <a class="archive-button" href="../PHP/blog_archivar.php?id=<?= $row['id'] ?>&accion=archivar" title="Archivar Post">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentcolor" d="M32 32l448 0c17.7 0 32 14.3 32 32l0 32c0 17.7-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96L0 64C0 46.3 14.3 32 32 32zm0 128l448 0 0 256c0 35.3-28.7 64-64 64L96 480c-35.3 0-64-28.7-64-64l0-256zm128 80c0 8.8 7.2 16 16 16l160 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-160 0c-8.8 0-16 7.2-16 16z"/>
                            </svg>
                        </a>
                    <?php else: ?>
                        <a class="unarchive-button" href="../PHP/blog_archivar.php?id=<?= $row['id'] ?>&accion=desarchivar" title="Publicar Post" style="color: #28a745;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentcolor" d="M32 32l448 0c17.7 0 32 14.3 32 32l0 32c0 17.7-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96L0 64C0 46.3 14.3 32 32 32zm0 128l448 0 0 256c0 35.3-28.7 64-64 64L96 480c-35.3 0-64-28.7-64-64l0-256zm192 80c0-8.8 7.2-16 16-16l96 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-96 0c-8.8 0-16-7.2-16-16z"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php 
            $counter++;
            endwhile; 
            ?>
    </tbody>
</table>
</div>

<!-- Sección Archivados -->
<div id="archivados" class="section-content">
    <h1>Blogs Archivados</h1>
        <div class="posts-actions">

    <button class="nav-bar-button" role="button" data-section="posts">Volver a Publicaciones</button>
                <div class="bulk-actions">
                <button id="bulk-archive" disabled>Archivar seleccionados</button>
            </div>
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th><input type="checkbox" id="select-all-archived"></th>
                <th>#</th>  <!-- Cambiado de ID a # -->
                <th>Título</th>
                <th>Categoría</th>
                <th>Fecha</th>
                <th>Estrellas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $counter = 1; // Inicializamos el contador para archivados
            while ($row = mysqli_fetch_assoc($result_archivados)) : ?>
                <tr>
                    <td><input type="checkbox" class="row-checkbox-archived" data-id="<?= $row['id'] ?>"></td>
                    <td><?= $counter ?></td>  <!-- Mostramos el número secuencial -->
                    <td><?= htmlspecialchars($row['titular']) ?></td>
                    <td><?= htmlspecialchars($row['categoria_nombre'] ?? 'Sin categoría') ?></td>
                    <td><?= htmlspecialchars($row['fecha']) ?></td>
                    <td><?= htmlspecialchars($row['rating_count'] ?? '0') ?></td>
                    <td style="display: flex; gap: 8px; align-items: center;">
                                                <!-- Botón Editar - Redirige a blog_edit.php -->
                        <a class="edit-button" href="../PHP/blog_edit.php?id=<?php echo $row['id']; ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentcolor" d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                            </svg>
                        </a>
                        <!-- Botón Desarchivar -->
                        <a class="unarchive-button" href="../PHP/blog_archivar.php?id=<?= $row['id'] ?>&accion=desarchivar" title="Publicar Post">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20">
                                <path fill="currentColor" d="M32 32h448c17.7 0 32 14.3 32 32v32c0 17.7-14.3 32-32 32H32C14.3 128 0 113.7 0 96V64C0 46.3 14.3 32 32 32zm0 128h448v256c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V160zm192 80c0-8.8 7.2-16 16-16h96c8.8 0 16 7.2 16 16s-7.2 16-16 16h-96c-8.8 0-16-7.2-16-16z"/>
                            </svg>
                        </a>

                        <!-- Botón Eliminar -->
                            <a class="delete-button" href="crud.php?eliminar=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar publicación?')" title="Eliminar artículo">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">                                    
                                    <path fill="currentcolor" d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                </svg>
                            </a>
                    </td>
                </tr>
            <?php 
                $counter++; // Incrementamos el contador
            endwhile; 
            ?>
        </tbody>
    </table>
</div>
        


<!-- Sección Categorías -->
<div id="categorias" class="section-content">
    <h1>Categorías</h1>
<!-- Formulario decorado para agregar categoría -->
<form method="POST" action="categoria_crud.php" class="form-categoria">
  <div class="form-row">
    <input type="text" name="nombre" placeholder="Nombre de la categoría" required>
    <input type="text" name="descripcion_corta" placeholder="Descripción corta" maxlength="255" required>
    <button type="submit" name="crear">Crear</button>
  </div>
</form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            mysqli_data_seek($result_categorias, 0);
            while ($cat = mysqli_fetch_assoc($result_categorias)): ?>
                <tr>
                    <td><?= $cat['id'] ?></td>
                    <td><?= htmlspecialchars($cat['nombre']) ?></td>
                    <td>
                      <!-- Botón Editar -->
                    <a class="edit-button" href="categoria_crud.php?editar=<?= $cat['id'] ?>" title="Editar categoría">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16">
                            <path fill="currentcolor" d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                        </svg>
                    </a>

                    <!-- Botón Eliminar -->
                    <a class="delete-button" href="categoria_crud.php?eliminar=<?= $cat['id'] ?>" onclick="return confirm('¿Eliminar categoría?')" title="Eliminar categoría">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="16" height="16">                                    
                            <path fill="currentcolor" d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                        </svg>
                    </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Nueva sección para mostrar las categorías en tarjetas -->
    <div class="categoria-container">
        <?php while ($categoria = mysqli_fetch_assoc($result_categorias)): ?>
            <div class="categoria-card">
                <h2><?= htmlspecialchars($categoria['nombre']) ?></h2>
                <p><?= htmlspecialchars($categoria['descripcion_corta']) ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<!-- Sección Usuarios -->
<div id="usuarios" class="section-content">
    <h1>Usuarios</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
             while ($row = mysqli_fetch_assoc($result_usuarios)) :
             if (empty($row)):
             ?>
                        <tr>
                            <td colspan="6" class="no-results">
                                <div class="no-results-message">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="no-results-icon">
                                        <path fill="currentColor" d="M256 32c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9L264 94.6l24.7 24.7c9.2 9.2 11.9 22.9 6.9 34.9S268.9 176 256 176s-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9L248 94.6l-24.7-24.7c-9.2-9.2-11.9-22.9-6.9-34.9S243.1 32 256 32zM160 256c17.7 0 32 14.3 32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V288c0-17.7 14.3-32 32-32h64zm128 0c17.7 0 32 14.3 32 32v96c0 17.7-14.3 32-32 32H224c-17.7 0-32-14.3-32-32V288c0-17.7 14.3-32 32-32h64zm128 0c17.7 0 32 14.3 32 32v96c0 17.7-14.3 32-32 32H352c-17.7 0-32-14.3-32-32V288c0-17.7 14.3-32 32-32h64z"/>
                                    </svg>
                                    <p>No hay comentarios disponibles</p>
                                    <span>Los comentarios aparecerán aquí</span>
                                </div>
                            </td>
                        </tr>

            <?php else: ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['rol']) ?></td>
                    <td>
                        <div class="action-buttons">

                            <!-- Botón Eliminar -->
                            <a class="delete-button" href="crud.php?eliminar_usuario=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar usuario?')" title="Eliminar usuario">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">                                    
                                    <path fill="currentcolor" d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Sección Comentarios -->
<div id="comentarios" class="section-content">
    <h1>Comentarios</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Usuario</th>
                <th>Comentario</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result_comentarios)) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['id_post']) ?></td>
                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                    <td><?= htmlspecialchars($row['comentario']) ?></td>
                    <td><?= htmlspecialchars($row['fecha']) ?></td>
                    <td>
                        <div class="action-buttons">
                            <!-- Botón Ver -->
                            <a class="view-button" href="../PHP/comentario_view.php?id=<?php echo $row['id']; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path fill="currentcolor" d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                </svg>
                            </a>

                            <!-- Botón Eliminar -->
                            <a class="delete-button" href="crud.php?eliminar_comentario=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar comentario?')" title="Eliminar comentario">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">                                    
                                    <path fill="currentcolor" d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Sección contacto -->
<div id="contacto" class="section-content">
    <h1>Mensajes de contacto</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Mensaje</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result_contacto)) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                    <td><?= htmlspecialchars($row['apellido']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['mensaje']) ?></td>
                    <td>
                        <div class="action-buttons">
                            <!-- Botón Eliminar -->
                            <a class="delete-button" href="crud.php?eliminar_contacto=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar mensaje de contacto?')" title="Eliminar mensaje">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">                                    
                                    <path fill="currentcolor" d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Sección Admin -->
<div id="admin" class="section-content">
    <h1>Admin</h1>
  <div class="posts-actions">
    <a class="crear-publicacion" href="admin_add.php" role="button">Agregar admin</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Num</th>
                <th>nombre</th>
                <th>email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result_admin)) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td>
                        <div class="action-buttons">

                            <!-- Botón Eliminar -->
                            <a class="delete-button" href="crud.php?eliminar_admin=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar administrador?')" title="Eliminar admin">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">                                    
                                    <path fill="currentcolor" d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

    <script>
        const buttons = document.querySelectorAll('.nav-bar-button');
        const sections = document.querySelectorAll('.section-content');

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                const target = btn.getAttribute('data-section');

                sections.forEach(section => {
                    section.classList.remove('active');
                });

                document.getElementById(target).classList.add('active');
            });
        });

    //Script apra el boton del bulk
document.addEventListener('DOMContentLoaded', function () {
    const bulkArchiveBtn = document.getElementById('bulk-archive');
    const checkboxes = document.querySelectorAll('.row-checkbox');
    const selectAll = document.getElementById('select-all-posts');

    // Habilitar botón si hay seleccionados
    function toggleButtonState() {
        const selected = document.querySelectorAll('.row-checkbox:checked');
        bulkArchiveBtn.disabled = selected.length === 0;
    }

    // Evento individual
    checkboxes.forEach(cb => cb.addEventListener('change', toggleButtonState));

    // Seleccionar todo
    selectAll.addEventListener('change', function () {
        checkboxes.forEach(cb => cb.checked = selectAll.checked);
        toggleButtonState();
    });

    // Enviar IDs para archivar
    bulkArchiveBtn.addEventListener('click', function () {
        const selectedIds = Array.from(document.querySelectorAll('.row-checkbox:checked'))
                                 .map(cb => cb.getAttribute('data-id'));

        if (selectedIds.length === 0) return;

        if (!confirm('¿Estás seguro de archivar las publicaciones seleccionadas?')) return;

        // Enviar a PHP por fetch
        fetch('../PHP/bulk_archive.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ids: selectedIds })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Publicaciones archivadas con éxito');
                location.reload(); // Recarga la página para ver los cambios
            } else {
                alert('Ocurrió un error al archivar.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Error en la solicitud');
        });
    });
});
</script>

</body>

</html>

