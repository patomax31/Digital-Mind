<?php
session_start();
include 'blog_db.php';

// Verificar si se recibió un ID válido
if (isset($_GET['id']) || is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM publicaciones_2 WHERE id = $id";
} else {
    $sql = "SELECT * FROM publicaciones_2 ORDER BY id DESC LIMIT 1";
}

$resultado = $conn->query($sql);
if (!$resultado || $resultado->num_rows === 0) {
    die("Publicación no encontrada");
}
$post = $resultado->fetch_assoc();

// Asegura que $id esté definido
$id = $post['id'];


$resultado = $conn->query($sql);


if (!$resultado || $resultado->num_rows === 0) {
    die("Publicación no encontrada");
}

$post = $resultado->fetch_assoc();
$pageTitle = htmlspecialchars($post['titular']) . ' - DIGITALMIND';

// Incluir el header
include 'header.php';
?>

<div class="container">
    <div class="category">
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


<section class="comentario">
<h2>Comentarios</h2>

<?php if (isset($_SESSION['usuario'])): ?>
    <form method="post" action="">
        <textarea name="comentario" rows="4" cols="50" required></textarea><br>
        <input type="submit" name="enviar_comentario" value="Publicar comentario">
    </form>
<?php else: ?>
    <p>Debes iniciar sesión para comentar.</p>
<?php endif; ?>

<hr>

<?php
// Insertar comentario si se envió
if (isset($_POST['enviar_comentario']) && isset($_SESSION['usuario'])) {
    $comentario = $conn->real_escape_string($_POST['comentario']);
    $usuario = $conn->real_escape_string($_SESSION['usuario']);
    $conn->query("INSERT INTO comentarios (id_post, nombre, comentario) VALUES ($id, '$usuario', '$comentario')");
}

// Mostrar comentarios del post actual
$comentarios = $conn->query("SELECT * FROM comentarios WHERE id_post = $id ORDER BY fecha DESC");

if ($comentarios && $comentarios->num_rows > 0) {
    while ($fila = $comentarios->fetch_assoc()) {
        echo "<div class='comentario'>";
        echo "<p><strong>" . htmlspecialchars($fila['nombre']) . "</strong></p>";
        echo "<p>" . nl2br(htmlspecialchars($fila['comentario'])) . "</p>";
        echo "<p><small><em>" . $fila['fecha'] . "</em></small></p>";
        echo "<hr></div>";
    }
} else {
    echo "<p>No hay comentarios aún.</p>";
}





include 'footer.php';

$conn->close();
?>