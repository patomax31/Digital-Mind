<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Blog</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/search.css">

    <script src="https://cdn.tiny.cloud/1/284zlkwr5hzs5rcf7ehl7m7vwg486wms44e13vnumr38i76e/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    
    <script>
    tinymce.init({
        selector: '#contenido',
        height: 300,
        menubar: false,
        branding: false,
        statusbar: false,
        plugins: 'lists link image preview code',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        // Asegurar que el HTML generado sea limpio
        valid_elements: 'p,strong/b,em/i,u,a[href|target],ul,ol,li,h1,h2,h3,h4,h5,h6,br,hr,img[src|alt]',
        // Convertir saltos de línea a párrafos
        forced_root_block: 'p',
        // No convertir caracteres especiales a entidades
        entity_encoding: 'raw'
    });
    </script>


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
<?php
include 'header.php';
?>
<div class="blog-form">
    <form action="../PHP/blog_save.php" method="POST" enctype="multipart/form-data">
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
            <label for="categoria">Categoría:</label>
            <select class="form-select" name="categoria" id="categoria" required>
                <option value="" disabled selected>Selecciona una categoría</option>
                <option value="Educación Primaria">📖 Educación Primaria</option>
                <option value="Educación Secundaria">📖 Educación Secundaria</option>
                <option value="Educación Preparatoria">📖 Educación Preparatoria</option>
                <option value="Métodos de Aprendizaje">🎯 Métodos de Aprendizaje</option>
                <option value="Educación Vocacional">💼 Educación Vocacional</option>
                <option value="Habilidades de Redacción">✍️ Habilidades de Redacción</option>
                <option value="Ciencia y Matemáticas">🧪 Ciencia y Matemáticas</option>
                <option value="Para Tutores">👨‍👩‍👧‍👦 Para Tutores</option>
            </select>
        </div>

        <div class="form-group">
            <label for="descripcion_corta">Descripción Corta:</label>
            <input type="text" name="descripcion_corta" id="descripcion_corta" required 
                   placeholder="Breve descripción que aparecerá en la vista previa">
        </div>
        
        <div class="form-group">
            <label for="contenido">Contenido:</label>
            <textarea name="contenido" id="contenido" rows="10"
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
        
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

        <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            const titular = document.getElementById('titular').value.trim();
            const contenido = tinymce.get('contenido').getContent({ format: 'text' }).trim();
            
            if (titular.length < 10 || contenido.length < 50) {
                e.preventDefault();
                alert('El título debe tener al menos 10 caracteres y el contenido 50 caracteres.');
            }
        });
        </script>
    </form>
</div>
</body>
</html>

