<?php
session_start();
include 'blog_db.php';

// Manejo de errores de la base de datos
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Obtener ID del post
    $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : null;

    // Consulta SQL
    $sql = $id ? "SELECT * FROM publicaciones_2 WHERE id = $id" 
               : "SELECT * FROM publicaciones_2 ORDER BY id DESC LIMIT 1";

    // Obtener datos del post
    $resultado = $conn->query($sql);
    if (!$resultado || $resultado->num_rows === 0) {
        throw new Exception("Publicación no encontrada");
    }

    $post = $resultado->fetch_assoc();
    $id = $post['id'];
    $pageTitle = htmlspecialchars($post['titular']) . ' - DIGITALMIND';

    // Verificar tablas
    $tableCheck = $conn->query("SHOW TABLES LIKE 'comentarios'");
    $commentsTableExists = $tableCheck->num_rows > 0;
    $tableCheck = $conn->query("SHOW TABLES LIKE 'valoraciones'");
    $ratingsTableExists = $tableCheck->num_rows > 0;

    // Procesar valoraciones
    $ratingFeedback = '';
    if (isset($_POST['submit_rating']) && $ratingsTableExists) {
        if (isset($_POST['rating']) && isset($_SESSION['usuario'])) {
            $rating = intval($_POST['rating']);
            $usuario = $conn->real_escape_string($_SESSION['usuario']);
            
            $check = $conn->query("SELECT * FROM valoraciones WHERE id_post = $id AND usuario = '$usuario'");
            
            if ($check->num_rows > 0) {
                $ratingFeedback = 'already_rated';
            } else {
                $conn->query("INSERT INTO valoraciones (id_post, usuario, valoracion) VALUES ($id, '$usuario', $rating)");
                $ratingFeedback = 'success';
            }
        } else {
            $ratingFeedback = 'login_required';
        }
    }

    // Procesar comentarios
    $commentFeedback = '';
    if (isset($_POST['enviar_comentario']) && $commentsTableExists) {
        if (isset($_SESSION['usuario'])) {
            $comentario = $conn->real_escape_string($_POST['comentario']);
            $usuario = $conn->real_escape_string($_SESSION['usuario']);
            $conn->query("INSERT INTO comentarios (id_post, nombre, comentario) VALUES ($id, '$usuario', '$comentario')");
            $commentFeedback = 'success';
        } else {
            $commentFeedback = 'login_required';
        }
    }

    // Obtener comentarios
    $comentarios = $commentsTableExists ? $conn->query("SELECT * FROM comentarios WHERE id_post = $id ORDER BY fecha DESC") : false;

} catch (mysqli_sql_exception $e) {
    die("Error de base de datos: " . $e->getMessage());
} catch (Exception $e) {
    die($e->getMessage());
}

include 'header.php';
?>

<div class="container">
                    <h1><?php echo htmlspecialchars($post['categoria']); ?></h1>
    </div>
    <main>

        </div>    
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="../css/modals.css">
    <link rel="stylesheet" href="../css/blog_style.css">
    <link rel="stylesheet" href="../css/blog_page_3.js">
</head>
<body>


<button id="scrollBtn" aria-label="Volver al inicio">
    <img src="../images/escuela1.jpg" alt="Subir">
</button>

<!-- Barra de progreso -->
<div class="progress-bar">
    <div class="progress"></div>
</div>

<!-- Contenedor principal -->
<div class="main-container">

    <!-- Cabecera del post -->
    <header class="post-header">
        <div class="post-header-text">
            <span class="category-tag"><?php echo htmlspecialchars($post['categoria']); ?></span>
            <h1><?php echo htmlspecialchars($post['titular']); ?></h1>
            <p><?php echo htmlspecialchars($post['descripcion_corta']); ?></p>
            
            <div class="post-meta">
                <p>Publicado por <strong><?php echo htmlspecialchars($post['autor'] ?? 'Admin'); ?></strong> el <?php echo date('d/m/Y', strtotime($post['fecha'])); ?></p>
            </div>
        </div>
        
        <div class="post-header-image">
            <?php if (!empty($post['imagen'])): ?>
                <img src="../images/publicaciones/<?php echo htmlspecialchars($post['imagen']); ?>" alt="<?php echo htmlspecialchars($post['titular']); ?>">
            <?php else: ?>
                <img src="../images/default-post.jpg" alt="Imagen por defecto">
            <?php endif; ?>
        </div>
    </header>

    <!-- Contenido principal -->
    <article class="post-content">
        <?php echo $post['contenido']; ?>
    </article>

 <!-- Sección de valoración corregida -->
<section class="rating-section">
    <h3>¿Qué te pareció este post?</h3>
    <form method="post" action="" class="rating-form" id="ratingForm">
        <div class="star-rating">
            <input type="radio" id="star1" name="rating" value="1">
            <label for="star1">★</label>
            
            <input type="radio" id="star2" name="rating" value="2">
            <label for="star2">★</label>
            
            <input type="radio" id="star3" name="rating" value="3">
            <label for="star3">★</label>
            
            <input type="radio" id="star4" name="rating" value="4">
            <label for="star4">★</label>
            
            <input type="radio" id="star5" name="rating" value="5">
            <label for="star5">★</label>
        </div>
        <input type="submit" name="submit_rating" value="Enviar valoración" class="rating-submit-btn">
    </form>
</section>

<!-- Scripts unificados al final del documento -->
<script>
// Sistema de valoración por estrellas
function setupStarRating() {
    const stars = document.querySelectorAll('.star-rating label');
    
    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            for (let i = 0; i < stars.length; i++) {
                stars[i].previousElementSibling.checked = i <= index;
            }
        });
        
        star.addEventListener('mouseover', () => {
            for (let i = 0; i <= index; i++) {
                stars[i].style.color = '#ffc107';
            }
        });
        
        star.addEventListener('mouseout', () => {
            const checkedInput = document.querySelector('.star-rating input:checked');
            const checkedIndex = checkedInput ? 
                Array.from(document.querySelectorAll('.star-rating input')).indexOf(checkedInput) : -1;
                
            stars.forEach((s, i) => {
                s.style.color = i <= checkedIndex ? '#ffc107' : '#ccc';
            });
        });
    });

    // Inicializar colores
    const checkedInput = document.querySelector('.star-rating input:checked');
    if (checkedInput) {
        const checkedIndex = Array.from(document.querySelectorAll('.star-rating input')).indexOf(checkedInput);
        stars.forEach((s, i) => {
            s.style.color = i <= checkedIndex ? '#ffc107' : '#ccc';
        });
    }
}

// Inicializar todo cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    setupStarRating();
    
    // Mostrar feedback después de que todo esté cargado
    <?php if ($ratingFeedback === 'success'): ?>
        setTimeout(() => {
            alert('¡Gracias por tu valoración!');
        }, 300);
    <?php elseif ($ratingFeedback === 'already_rated'): ?>
        setTimeout(() => {
            alert('Ya has valorado este post.');
        }, 300);
    <?php elseif ($ratingFeedback === 'login_required'): ?>
        setTimeout(() => {
            alert('Debes iniciar sesión para valorar.');
        }, 300);
    <?php endif; ?>

    <?php if ($commentFeedback === 'success'): ?>
        setTimeout(() => {
            alert('¡Comentario publicado con éxito!');
        }, 300);
    <?php elseif ($commentFeedback === 'login_required'): ?>
        setTimeout(() => {
            alert('Debes iniciar sesión para comentar.');
        }, 300);
    <?php endif; ?>
});
</script>

    <!-- Sección de referencias -->
    <?php if (!empty($post['referencia'])): ?>
    <section class="references-container">
        <div class="references-content">
            <h2>Referencias</h2>
            <p><?php echo htmlspecialchars($post['referencia']); ?></p>
        </div>
    </section>
    <?php endif; ?>

    <!-- Sección de comentarios -->
    <section class="comments-section">
        <h2>Comentarios</h2>

        <?php if (!$commentsTableExists): ?>
            <div class="no-comments">
                <p>El sistema de comentarios no está disponible temporalmente.</p>
            </div>
        <?php else: ?>
            <!-- Formulario de comentarios -->
            <div class="comment-form-container">
                <?php if (isset($_SESSION['usuario'])): ?>
                    <form method="post" action="" id="commentForm">
                        <textarea name="comentario" placeholder="Escribe tu comentario..." required></textarea>
                        <input type="submit" name="enviar_comentario" value="Publicar comentario">
                    </form>
                <?php else: ?>
                    <div class="login-prompt">
                        <p>Debes <a href="/login">iniciar sesión</a> para comentar.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Lista de comentarios -->
            <div class="comments-list">
                <?php if ($comentarios && $comentarios->num_rows > 0): ?>
                    <?php while ($fila = $comentarios->fetch_assoc()): ?>
                        <div class="comment-item">
                            <div class="comment-header">
                                <strong><?php echo htmlspecialchars($fila['nombre']); ?></strong>
                                <span class="comment-date"><?php echo $fila['fecha']; ?></span>
                            </div>
                            <div class="comment-body">
                                <?php echo nl2br(htmlspecialchars($fila['comentario'])); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="no-comments">
                        <p>No hay comentarios aún. ¡Sé el primero en comentar!</p>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </section>
</div>


<?php
include 'footer.php';
$conn->close();
?>

<!-- Ventana modal para feedback -->
<div id="feedbackModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:1000; justify-content:center; align-items:center;">
    <div style="background:white; padding:2rem; border-radius:10px; text-align:center; max-width:400px;">
        <h3 id="modalTitle"></h3>
        <p id="modalMessage"></p>
        <button onclick="document.getElementById('feedbackModal').style.display='none'" 
                style="margin-top:1rem; padding:0.5rem 1rem; background:#294c5b; color:white; border:none; border-radius:5px; cursor:pointer;">
            Cerrar
        </button>
    </div>
</div>
<script>
// Inicializar todo cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    setupStarRating();
    
    // Mostrar feedback después de que todo esté cargado
    <?php if ($ratingFeedback === 'success'): ?>
        setTimeout(() => {
            showModal('¡Gracias!', 'Tu valoración ha sido registrada.');
        }, 300);
    <?php elseif ($ratingFeedback === 'already_rated'): ?>
        setTimeout(() => {
            showModal('Atención', 'Ya has valorado este post.');
        }, 300);
    <?php elseif ($ratingFeedback === 'login_required'): ?>
        setTimeout(() => {
            showModal('Acceso requerido', 'Debes iniciar sesión para valorar.');
        }, 300);
    <?php endif; ?>

    <?php if ($commentFeedback === 'success'): ?>
        setTimeout(() => {
            showModal('¡Éxito!', 'Tu comentario ha sido publicado.');
        }, 300);
    <?php elseif ($commentFeedback === 'login_required'): ?>
        setTimeout(() => {
            showModal('Acceso requerido', 'Debes iniciar sesión para comentar.');
        }, 300);
    <?php endif; ?>
});
</script>