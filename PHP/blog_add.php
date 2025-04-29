<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Blog</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="includeHeader.js" defer></script>
    <script src="includeFooter.js" defer></script>
    <style>
        /* Estilos específicos para el formulario */
        .blog-form {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .blog-form h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #34495e;
        }
        
        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group input[type="url"],
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }
        
        .form-group textarea {
            min-height: 200px;
            resize: vertical;
        }
        
        .submit-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block;
            width: 100%;
            font-weight: 600;
        }
        
        .submit-btn:hover {
            background-color: #2980b9;
        }
        
        @media (max-width: 768px) {
            .blog-form {
                padding: 1rem;
                margin: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="blog-form">
        <form action="blog_save.php" method="POST" enctype="multipart/form-data">
            <h2>Crear Nueva Publicación</h2>
            
            <div class="form-group">
                <label for="titular">Titular:</label>
                <input type="text" name="titular" id="titular" required placeholder="Ingresa un título llamativo">
            </div>
            
            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" name="fecha" id="fecha" required>
            </div>
            
            <div class="form-group">
                <label for="descripcion_corta">Descripción Corta:</label>
                <input type="text" name="descripcion_corta" id="descripcion_corta" required 
                       placeholder="Breve descripción que aparecerá en la vista previa">
            </div>
            
            <div class="form-group">
                <label for="contenido">Contenido:</label>
                <textarea name="contenido" id="contenido" rows="10" required
                          placeholder="Escribe aquí el contenido completo de tu publicación..."></textarea>
            </div>
            
            <div class="form-group">
                <label for="referencia">Referencia (opcional):</label>
                <input type="url" name="referencia" id="referencia" placeholder="https://ejemplo.com">
            </div>
            
            <div class="form-group">
                <label for="imagen">Imagen destacada:</label>
                <input type="file" name="imagen" id="imagen" accept="image/*">
                <small>Sube una imagen que represente tu publicación (opcional)</small>
            </div>
            
            <button type="submit" class="submit-btn">Publicar Entrada</button>
        </form>
    </div>
</body>
</html>