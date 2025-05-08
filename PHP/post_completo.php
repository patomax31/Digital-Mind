<?php
include 'blog_db.php';

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
$pageTitle = htmlspecialchars($post['titular']) . ' - DIGITALMIND';

// Incluir el header
include 'header.php';
?>

<div class="container">
    <main>
        <div class="title-container-blog">    
            <section class="title-content">
                <div class="text">
                    <h1><?php echo htmlspecialchars($post['titular']); ?></h1>
                    <p><?php echo htmlspecialchars($post['descripcion_corta']); ?></p>
                </div>
                <div class="title-image">
                    <?php if (!empty($post['imagen'])): ?>
                        <img src="../images/publicaciones/<?php echo htmlspecialchars($post['imagen']); ?>" alt="<?php echo htmlspecialchars($post['titular']); ?>">
                    <?php else: ?>
                        <img src="../images/default-post.jpg" alt="Imagen por defecto">
                    <?php endif; ?>
                </div>
            </section>        
        </div>    

        <section class="container-blog">   
            <section class="content">
                <?php 
                // Mostrar el contenido HTML directamente (sin htmlspecialchars)
                echo $post['contenido'];
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
</div>

<?php
// Incluir el footer
include 'footer.php';
$conn->close();
?>