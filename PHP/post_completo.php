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
    
    // URL canónica para compartir
    $canonicalUrl = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="../css/modals.css">
    <link rel="stylesheet" href="../css/blog_style.css">
    <link rel="stylesheet" href="../css/blog_page_3.js">
    
    <!-- Meta tags para redes sociales (Open Graph y Twitter) -->
    <meta property="og:title" content="<?php echo htmlspecialchars($post['titular']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($post['descripcion_corta']); ?>">
    <meta property="og:url" content="<?php echo $canonicalUrl; ?>">
    <meta property="og:type" content="article">
    <meta property="og:site_name" content="DIGITALMIND">
    <?php if (!empty($post['imagen'])): ?>
    <meta property="og:image" content="https://<?php echo $_SERVER['HTTP_HOST']; ?>/images/publicaciones/<?php echo htmlspecialchars($post['imagen']); ?>">
    <meta name="twitter:image" content="https://<?php echo $_SERVER['HTTP_HOST']; ?>/images/publicaciones/<?php echo htmlspecialchars($post['imagen']); ?>">
    <?php endif; ?>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($post['titular']); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($post['descripcion_corta']); ?>">
    
    <!-- Favicon -->
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
</head>
<body>

<div class="container">
    <h1><?php echo htmlspecialchars($post['categoria']); ?></h1>
</div>

<main>
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
            
            <!-- Sección de compartir al final del artículo -->
            <div class="social-share-bottom">
                <h3>¿Te gustó este artículo? ¡Compártelo!</h3>
                <div class="share-buttons">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($canonicalUrl); ?>" target="_blank" rel="noopener noreferrer" class="share-button facebook" title="Compartir en Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode(htmlspecialchars($post['titular'])) . ' ' . urlencode($canonicalUrl); ?>" target="_blank" rel="noopener noreferrer" class="share-button twitter" title="Compartir en Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($canonicalUrl); ?>&title=<?php echo urlencode(htmlspecialchars($post['titular'])); ?>&summary=<?php echo urlencode(htmlspecialchars($post['descripcion_corta'])); ?>" target="_blank" rel="noopener noreferrer" class="share-button linkedin" title="Compartir en LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="whatsapp://send?text=<?php echo urlencode(htmlspecialchars($post['titular']) . ' - ' . $canonicalUrl); ?>" target="_blank" rel="noopener noreferrer" class="share-button whatsapp" title="Compartir en WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="mailto:?subject=<?php echo urlencode(htmlspecialchars($post['titular'])); ?>&body=<?php echo urlencode("Mira este artículo: " . $canonicalUrl); ?>" class="share-button email" title="Compartir por email">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>
        </article>

        <!-- Sección de valoración -->
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
</main>

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

<!-- Font Awesome para los iconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
    /* Estilos para los botones de compartir */
    .social-share-buttons {
        margin: 20px 0;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .social-share-buttons span {
        margin-right: 10px;
        font-weight: bold;
    }
    
    .social-button, .share-button {
        padding: 8px 15px;
        border-radius: 4px;
        color: white;
        text-decoration: none;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.3s ease;
    }
    
    .share-button {
        padding: 10px;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        justify-content: center;
    }
    
    .social-button:hover, .share-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .facebook, .share-button.facebook {
        background-color: #3b5998;
    }
    
    .twitter, .share-button.twitter {
        background-color: #1da1f2;
    }
    
    .linkedin, .share-button.linkedin {
        background-color: #0077b5;
    }
    
    .whatsapp, .share-button.whatsapp {
        background-color: #25d366;
    }
    
    .email, .share-button.email {
        background-color: #dd4b39;
    }
    
    .social-share-bottom {
        margin: 40px 0;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
        text-align: center;
    }
    
    .social-share-bottom h3 {
        margin-bottom: 15px;
    }
    
    .share-buttons {
        display: flex;
        justify-content: center;
        gap: 15px;
    }
</style>

<script>
// Función para compartir en redes sociales
function shareOnSocial(network) {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);
    let shareUrl;
    
    switch(network) {
        case 'facebook':
            shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
            break;
        case 'twitter':
            shareUrl = `https://twitter.com/intent/tweet?text=${title}&url=${url}`;
            break;
        case 'linkedin':
            shareUrl = `https://www.linkedin.com/shareArticle?mini=true&url=${url}&title=${title}`;
            break;
        case 'whatsapp':
            shareUrl = `whatsapp://send?text=${title} - ${url}`;
            break;
        case 'email':
            shareUrl = `mailto:?subject=${title}&body=Mira este artículo: ${url}`;
            break;
    }
    
    window.open(shareUrl, '_blank', 'noopener,noreferrer');
}

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

// Mostrar modal
function showModal(title, message) {
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalMessage').textContent = message;
    document.getElementById('feedbackModal').style.display = 'flex';
}

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
</body>
</html>