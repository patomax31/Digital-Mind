<?php
include 'blog_db.php'; // Asegúrate de que este archivo contiene la conexión a la DB

// Verificar si se recibió un ID válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de publicación no válido");
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM publicaciones_2 WHERE id = $id";
$resultado = $conn->query($sql);

if ($resultado->num_rows === 0) {
    die("Publicación no encontrada");
}

$post = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['titular']); ?> - DIGITALMIND</title>
    <link rel="stylesheet" href="../css/blog_style_Mk2.css">
</head>
<body>
    <header>
        <section class="header-content">
            <div class="logo">
               <a href="../PHP/main_page.php"> 
                <img src="../images/Logo_Mk2.png" alt="Logo">
               </a>
            </div>
            <nav class="nav-center">
                <div class="create-container">
                    <svg class="create-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
                    </svg>
                    <a href="../PHP/publicaciones.php" class="create-buttom">Crear Blog</a>
                </div> 
                
                <div class="category-container">
                    <svg class="category-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                      <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 0 0-3 3v4.318a3 3 0 0 0 .879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 0 0 5.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 0 0-2.122-.879H5.25ZM6.375 7.5a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25Z" clip-rule="evenodd" />
                    </svg>
                    <a href="#" class="category-buttom">Categoría</a>
                </div>

                <nav class="login-bottom">
                    <svg class="Login-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                    </svg>
                    <a href="../PHP/register.php" class="search-button">Iniciar sesión</a>
                </nav>
            </nav>
        </section>
    </header>
    
    <main>
        <div class="progress-bar">
            <div id="progress" class="progress"></div>
        </div>
        
        <div class="title-container-blog">    
            <section class="title-content">
                <div class="text">
                    <h1><?php echo htmlspecialchars($post['titular']); ?></h1>
                    <p><?php echo htmlspecialchars($post['descripcion_corta']); ?></p>
                </div>
                <div class="title-image">
                    <?php if (!empty($post['referencia'])): ?>
                        <img src="<?php echo htmlspecialchars($post['referencia']); ?>" alt="<?php echo htmlspecialchars($post['titular']); ?>">
                    <?php else: ?>
                        <img src="../images/default-post.jpg" alt="Imagen por defecto">
                    <?php endif; ?>
                </div>
            </section>        
        </div>    

        <section class="container-blog">   
            <section class="content">
                <?php 
                // Convertir saltos de línea en párrafos HTML
                $contenido = nl2br(htmlspecialchars($post['contenido']));
                echo '<p>' . $contenido . '</p>';
                ?>
            </section>

            <button id="scrollBtn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.5" stroke="currentColor" class="size-6">
                 <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                </svg>   
            </button>
            <script src="../Js/blog_page_3.js"></script>
        </section>    

        <?php if (!empty($post['referencia'])): ?>
        <div class="container-reference">      
            <div class="reference-content">
                <h2>Referencias</h2>
                <p><?php echo htmlspecialchars($post['referencia']); ?></p>
            </div>
        </div>  
        <?php endif; ?>
    </main>

    <footer>
        <div class="footer-content">
          <p>Derechos Reservados &reg; Digital-Mind &copy; <?php echo date('Y'); ?></p>
        </div>
    </footer>
      
    <script src="../Js/progress-bar.js"></script>
</body>
</html>
<?php
$conn->close();
?>