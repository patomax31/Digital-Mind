<?php
require 'blog_db.php';


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['titular']); ?> - Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .post-content img {
            max-width: 100%;
            height: auto;
            margin: 1rem 0;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container mt-4">
        <div class="card mb-4">
            <?php if ($post['imagen']): ?>
            <img src="../images/publicaciones/<?php echo htmlspecialchars($post['imagen']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($post['titular']); ?>">
            <?php endif; ?>
            
            <div class="card-body">
                <h1 class="card-title"><?php echo htmlspecialchars($post['titular']); ?></h1>
                <p class="text-muted">Publicado el <?php echo date('d/m/Y', strtotime($post['fecha'])); ?></p>
                <p class="lead"><?php echo htmlspecialchars($post['descripcion_corta']); ?></p>
                
                <div class="post-content">
                    <?php echo htmlspecialchars_decode($post['contenido']); ?>
                </div>
                
                <?php if ($post['referencia']): ?>
                <div class="mt-4">
                    <h5>Referencia:</h5>
                    <a href="<?php echo htmlspecialchars($post['referencia']); ?>" target="_blank"><?php echo htmlspecialchars($post['referencia']); ?></a>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="card-footer text-muted">
                <a href="blog_list.php" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>
                
                <?php if (isset($_SESSION['usuario_id'])): ?>
                <div class="float-end">
                    <a href="blog_edit.php?id=<?php echo $post['id']; ?>" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <a href="blog_delete.php?id=<?php echo $post['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Eliminar este post?')">
                        <i class="bi bi-trash"></i> Eliminar
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>