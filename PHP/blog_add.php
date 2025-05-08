<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Blog</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/search.css">

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
<header class="page-header-footer sliding-header" id="slidingHeader">
    <div class="page-container">
      <div class="header-left">
        <div class="logo">
          <a href="../PHP/index.php">
            <img src="../images/Logo_Mk2.png" alt="Logo de DIGITALMIND">
          </a>
        </div>
        <div class="header-actions-left">
          <div class="action-container">
            <svg class="create-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
              <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
            </svg>
            <a href="../PHP/blog_add.php" class="">Crear Blog</a>
          </div>
          <div class="action-container">
            <svg class="category-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 0 0-3 3v4.318a3 3 0 0 0 .879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 0 0 5.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 0 0-2.122-.879H5.25ZM6.375 7.5a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25Z" clip-rule="evenodd" />
            </svg>
            <a href="#" class="">Categoría</a>
          </div>
        </div>
      </div>
      <div class="header-right">
        <div class="action-container">
          <svg class="Login-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
          </svg>
          <a href="../PHP/register.php" class="">Iniciar sesión</a>
        </div>
        <div class="search-container">
          <div class="pill-search">
            <div class="search-icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z" clip-rule="evenodd" />
              </svg>
            </div>
            <input type="text" class="search-input" placeholder="Buscar...">
          </div>
        </div>
      </div>
    </div>
  </header>
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
            
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

            <script>
document.querySelector('form').addEventListener('submit', function(e) {
    const titular = document.getElementById('titular').value.trim();
    const contenido = document.getElementById('contenido').value.trim();
    
    if (titular.length < 10 || contenido.length < 50) {
        e.preventDefault();
        alert('El título debe tener al menos 10 caracteres y el contenido 50 caracteres');
    }
});
</script>

        </form>
    </div>
</body>
</html>

