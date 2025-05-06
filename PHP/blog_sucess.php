<?php
// blog_success.php
if (empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$idPublicacion = intval($_GET['id']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicación Exitosa</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <!-- Incluye tu header aquí -->
    </header>
    
    <main class="success-container">
        <div class="success-message">
            <h2>¡Publicación creada con éxito!</h2>
            <p>Tu entrada ha sido guardada correctamente.</p>
            <div class="success-actions">
                <a href="post_completo.php?id=<?= $idPublicacion ?>" class="btn">Ver publicación</a>
                <a href="blog_add.php" class="btn">Crear otra publicación</a>
                <a href="index.php" class="btn">Volver al inicio</a>
            </div>
        </div>
    </main>
    
    <style>
        .success-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            text-align: center;
        }
        
        .success-message {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .success-message h2 {
            color: #27ae60;
            margin-bottom: 1rem;
        }
        
        .success-actions {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
            justify-content: center;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background 0.3s;
        }
        
        .btn:hover {
            background: #2980b9;
        }
    </style>
</body>
</html>