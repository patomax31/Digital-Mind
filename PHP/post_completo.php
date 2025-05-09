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
    <div calss="category">
                    <h1><?php echo htmlspecialchars($post['categoria']); ?></h1>
    </div>
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
    <script src="/Js/progress-bar.js"></script>

<?php
// Incluir el footer
include 'footer.php';
$conn->close();
?>