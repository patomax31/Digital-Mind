<?php
require 'blog_db.php';
session_start();

// Validar ID desde la URL
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : null;
if (!$id) {
    die("ID de publicación no válido.");
}

// Generar token CSRF si no existe
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Consultar la publicación por ID
$sql = "SELECT * FROM publicaciones_2 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    die("Publicación con ID $id no encontrada.");
}

$post = $resultado->fetch_assoc();
$pageTitle = htmlspecialchars($post['titular']) . ' - DIGITALMIND';

// Variables individuales
$titular = $post['titular'];
$fecha = $post['fecha'];
$descripcion_corta = $post['descripcion_corta'] ?? '';
$contenido = $post['contenido'] ?? '';
$imagen = $post['imagen'] ?? '';
$referencia = $post['referencia'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Post - Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <script src="https://cdn.tiny.cloud/1/284zlkwr5hzs5rcf7ehl7m7vwg486wms44e13vnumr38i76e/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#contenido',
            plugins: 'lists link image table code help',
            toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image | code',
            height: 400,
            promotion: false
        });
    </script>
</head>
<body>
<?php include 'dashboard.php'; ?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="mb-0">Editar Publicación (ID: <?php echo $id; ?>)</h4>
        </div>
        <div class="card-body">
            <form action="blog_update.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <div class="mb-3">
                    <label for="titular" class="form-label">Título</label>
                    <input type="text" class="form-control" id="titular" name="titular" value="<?php echo htmlspecialchars($titular); ?>" required>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $fecha; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="imagen" class="form-label">Imagen Destacada</label>
                        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                        <?php if (!empty($imagen)): ?>
                        <div class="mt-2">
                            <img src="../images/publicaciones/<?php echo htmlspecialchars($imagen); ?>" width="100" class="img-thumbnail">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="eliminar_imagen" id="eliminar_imagen">
                                <label class="form-check-label" for="eliminar_imagen">Eliminar imagen actual</label>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="descripcion_corta" class="form-label">Descripción Corta</label>
                    <textarea class="form-control" id="descripcion_corta" name="descripcion_corta" rows="2" required><?php echo htmlspecialchars($descripcion_corta); ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="contenido" class="form-label">Contenido</label>
                    <textarea id="contenido" name="contenido" class="form-control"><?php echo htmlspecialchars_decode($contenido); ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="referencia" class="form-label">Referencia (URL)</label>
                    <input type="url" class="form-control" id="referencia" name="referencia" value="<?php echo htmlspecialchars($referencia); ?>">
                </div>

                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Actualizar Publicación
                    </button>
                    <a href="admin_panel.php" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
