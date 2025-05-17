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

    // Obtener posts para el carrusel (excluyendo el actual, orden aleatorio, mínimo 3)
    $sql_carrusel = "SELECT * FROM publicaciones_2 WHERE id != $id ORDER BY RAND() LIMIT 5";
    $resultado_carrusel = $conn->query($sql_carrusel);
    $slides = [];
    if ($resultado_carrusel->num_rows > 0) {
        while ($fila = $resultado_carrusel->fetch_assoc()) {
            $slides[] = $fila;
        }
    }

    // Si hay menos de 3 posts, obtener más sin excluir el actual (para asegurar mínimo 3)
    if (count($slides) < 3) {
        $sql_fallback = "SELECT * FROM publicaciones_2 ORDER BY RAND() LIMIT " . (3 - count($slides));
        $resultado_fallback = $conn->query($sql_fallback);
        while ($fila = $resultado_fallback->fetch_assoc()) {
            // Evitar duplicados
            if ($fila['id'] != $id && !in_array($fila['id'], array_column($slides, 'id'))) {
                $slides[] = $fila;
            }
        }
    }

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
    
    <!-- Meta tags para redes sociales -->
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

    <style>
/* Estilos para el carrusel (aún más pequeño y adaptable) */
.related-posts-carousel {
    margin: 20px 0; /* Reducir aún más el margen vertical */
    padding: 15px 0; /* Reducir aún más el padding vertical */
    border-top: 1px solid #eee; /* Borde aún más ligero */
    border-bottom: 1px solid #eee; /* Borde aún más ligero */
}

.related-posts-carousel h2 {
    text-align: center;
    margin-bottom: 15px; /* Reducir aún más el margen inferior */
    color: #444;
    position: relative;
    font-size: 1.3em; /* Reducir ligeramente el tamaño del título de la sección */
}

.related-posts-carousel h2:after {
    content: '';
    display: block;
    width: 40px; /* Reducir aún más el ancho de la línea */
    height: 1.5px; /* Reducir aún más la altura de la línea */
    background: #777;
    margin: 4px auto 0; /* Reducir aún más el margen superior */
}

.carousel-container {
    width: 90%; /* Aumentar un poco para mejor adaptación en anchos menores */
    max-width: 600px; /* Limitar el ancho máximo en pantallas grandes */
    position: relative;
    margin: 15px auto; /* Reducir aún más el margen vertical */
    overflow: hidden;
    border-radius: 6px; /* Reducir aún más el radio del borde */
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08); /* Reducir aún más la sombra */
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.carousel-container:hover {
    transform: scale(1.005); /* Reducir el efecto hover */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.12);
}

.carousel-slides {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.carousel-slide {
    position: relative;
    height: 280px; /* Reducir significativamente la altura del slide */
    flex-shrink: 0;
    width: calc(100% / <?php echo count($slides) > 0 ? count($slides) : 1; ?>);
}

.carousel-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.carousel-caption {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.6)); /* Ligeramente menos oscuro */
    color: white;
    padding: 8px; /* Reducir aún más el padding del caption */
}

.carousel-caption h3 {
    margin: 0 0 3px 0; /* Reducir aún más el margen inferior */
    font-size: 1em; /* Reducir aún más el tamaño del título */
    color: white !important;
    padding: 2px 4px; /* Ajustar el padding del marco */
    display: inline-block;
    border-radius: 2px; /* Reducir aún más el radio del borde */
    background-color: rgba(0, 0, 0, 0.7); /* Marco ligeramente menos oscuro */
}

.carousel-caption p {
    margin: 0;
    font-size: 0.8em; /* Reducir aún más el tamaño de la descripción */
    color: #ddd !important;
    display: none; /* Mantener oculta por defecto */
}

.carousel-date {
    font-size: 0.7em; /* Reducir aún más el tamaño de la fecha */
    opacity: 0.6;
    margin-bottom: 2px; /* Reducir aún más el margen inferior */
    display: block;
    color: #ccc !important;
}

.carousel-link {
    display: inline-block;
    margin-top: 3px; /* Reducir aún más el margen superior */
    color: white;
    text-decoration: none;
    background-color: rgba(255, 255, 255, 0.05); /* Fondo aún más sutil */
    padding: 4px 8px; /* Reducir aún más el padding del enlace */
    border-radius: 12px; /* Reducir aún más el radio del borde */
    transition: background-color 0.3s, transform 0.3s;
    font-size: 0.7em; /* Reducir aún más el tamaño del enlace */
}

.carousel-link:hover {
    background-color: rgba(255, 255, 255, 0.15);
    transform: scale(1.02);
}

.carousel-controls {
    position: absolute;
    top: 0;
    bottom: 0;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    pointer-events: none;
}

.carousel-control {
    background-color: rgba(0, 0, 0, 0.2); /* Fondo aún más sutil */
    color: white;
    border: none;
    width: 25px; /* Reducir aún más el tamaño del control */
    height: 25px; /* Reducir aún más el tamaño del control */
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    margin: 0 8px; /* Reducir aún más el margen */
    transition: background-color 0.3s;
    pointer-events: auto;
    font-size: 0.9em; /* Reducir aún más el tamaño del icono */
}

.carousel-control:hover {
    background-color: rgba(0, 0, 0, 0.4);
}

.carousel-indicators {
    position: absolute;
    bottom: 8px; /* Reducir aún más la distancia desde abajo */
    left: 0;
    right: 0;
    display: flex;
    justify-content: center;
    gap: 4px; /* Reducir aún más el espacio entre indicadores */
}

.carousel-indicator {
    width: 6px; /* Reducir aún más el tamaño del indicador */
    height: 6px; /* Reducir aún más el tamaño del indicador */
    background-color: rgba(255, 255, 255, 0.2); /* Color aún más claro */
    border-radius: 50%;
    cursor: pointer;
    transition: background-color 0.3s;
}

.carousel-indicator.active {
    background-color: white;
}

@media (max-width: 768px) {
    .carousel-slide {
        height: 220px; /* Reducir aún más la altura en móviles */
    }
}
</style>
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
           <!-- Sección de valoración -->
    <section class="rating-section">
        <h3>¿Qué te pareció este post?</h3>
        <!-- Asegúrate de que la acción del formulario apunte al script que procesará la valoración -->
        <!-- También necesitas una forma de pasar el ID del post, aquí usamos un input oculto -->
        <form method="post" action="" class="rating-form" id="ratingForm">
            <!-- Reemplaza '<?php echo $post_id; ?>' con la variable PHP que contiene el ID del post -->
            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
            <div class="star-rating">
                <!-- Estrellas en orden inverso para CSS RTL -->
                <input type="radio" id="star5" name="rating" value="5"><label for="star5">★</label>
                <input type="radio" id="star4" name="rating" value="4"><label for="star4">★</label>
                <input type="radio" id="star3" name="rating" value="3"><label for="star3">★</label>
                <input type="radio" id="star2" name="rating" value="2"><label for="star2">★</label>
                <input type="radio" id="star1" name="rating" value="1"><label for="star1">★</label>
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

        <!-- Carrusel "Podría interesarte" -->
        <section class="related-posts-carousel">
            <h2>Podría interesarte</h2>
            <?php if (!empty($slides)): ?>
                <div class="carousel-container">
                    <div class="carousel-slides" id="postCarouselSlides">
                        <?php foreach ($slides as $index => $slide): ?>
                            <div class="carousel-slide">
                                <?php
                                $imagen = !empty($slide['imagen'])
                                    ? '../images/publicaciones/' . htmlspecialchars($slide['imagen'])
                                    : '../images/escuela1.jpg';
                                ?>
                                <img src="<?php echo $imagen; ?>" alt="<?php echo htmlspecialchars($slide['titular']); ?>" class="carousel-image">

                                <div class="carousel-caption">
                                    <h3><?php echo htmlspecialchars($slide['titular']); ?></h3>
                                    <span class="carousel-date">Publicado el <?php echo date("d/m/Y", strtotime($slide['fecha'])); ?></span>
                                    <p><?php echo htmlspecialchars(substr($slide['descripcion_corta'], 0, 120) . (strlen($slide['descripcion_corta']) > 120 ? '...' : '')); ?></p>
                                    <a href="post_completo.php?id=<?php echo $slide['id']; ?>" class="carousel-link">Ver más</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if (count($slides) > 1): ?>
                        <div class="carousel-controls">
                            <button class="carousel-control post-carousel-prev">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
                                    <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
                                </svg>
                            </button>
                            <button class="carousel-control post-carousel-next">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
                                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                                </svg>
                            </button>
                        </div>

                        <div class="carousel-indicators" id="postCarouselIndicators">
                            <?php for ($i = 0; $i < count($slides); $i++): ?>
                                <div class="carousel-indicator <?php echo $i === 0 ? 'active' : ''; ?>" data-index="<?php echo $i; ?>"></div>
                            <?php endfor; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <p>No hay publicaciones relacionadas disponibles.</p>
            <?php endif; ?>
        </section>

        <!-- Sección de comentarios -->
        <section class="comments-section" id="comments">
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

// Funcionalidad del carrusel
function setupCarousel() {
    const slides = document.getElementById('postCarouselSlides');
    const indicators = document.querySelectorAll('#postCarouselIndicators .carousel-indicator');
    const prevBtn = document.querySelector('.post-carousel-prev');
    const nextBtn = document.querySelector('.post-carousel-next');
    const carouselContainer = document.querySelector('.carousel-container');
    
    let currentIndex = 0;
    const slideCount = <?php echo count($slides); ?>;

    if (slideCount === 0) {
        document.querySelector('.related-posts-carousel').style.display = 'none';
        return;
    }

    // Ajustar el ancho del contenedor de slides según la cantidad
    slides.style.width = `${slideCount * 100}%`;
    
    // Ajustar el ancho de cada slide
    document.querySelectorAll('.carousel-slide').forEach(slide => {
        slide.style.width = `${100 / slideCount}%`;
    });

    function showSlide(index) {
        if (index < 0) index = slideCount - 1;
        if (index >= slideCount) index = 0;

        currentIndex = index;
        slides.style.transform = `translateX(-${currentIndex * (100 / slideCount)}%)`;

        indicators.forEach((indicator, i) => {
            indicator.classList.toggle('active', i === currentIndex);
        });
    }

    prevBtn.addEventListener('click', () => {
        showSlide(currentIndex - 1);
    });

    nextBtn.addEventListener('click', () => {
        showSlide(currentIndex + 1);
    });

    // Configurar indicadores solo si hay más de 1 slide
    if (slideCount > 1) {
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                showSlide(index);
            });
        });

        let interval = setInterval(() => {
            showSlide(currentIndex + 1);
        }, 5000);

        carouselContainer.addEventListener('mouseenter', () => {
            clearInterval(interval);
        });

        carouselContainer.addEventListener('mouseleave', () => {
            interval = setInterval(() => {
                showSlide(currentIndex + 1);
            }, 5000);
        });
    } else {
        // Ocultar controles si solo hay 1 slide
        document.querySelector('.carousel-controls').style.display = 'none';
        document.querySelector('.carousel-indicators').style.display = 'none';
    }

    showSlide(0);
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
    setupCarousel();
    
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