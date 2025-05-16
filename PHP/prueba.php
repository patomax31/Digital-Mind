<?php
session_start();
include 'blog_db.php';

/* ====================== */
/*  SECCIÓN DE CONFIGURACIÓN */
/* ====================== */

// Obtener ID del post
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : null;

// Consulta SQL según si hay ID o no
$sql = $id ? "SELECT * FROM publicaciones_2 WHERE id = $id" 
           : "SELECT * FROM publicaciones_2 ORDER BY id DESC LIMIT 1";

/* ====================== */
/*  SECCIÓN DE DATOS DEL POST */
/* ====================== */

$resultado = $conn->query($sql);
if (!$resultado || $resultado->num_rows === 0) {
    die("Publicación no encontrada");
}

$post = $resultado->fetch_assoc();
$id = $post['id']; // Asegurar que $id esté definido
$pageTitle = htmlspecialchars($post['titular']) . ' - DIGITALMIND';

/* ====================== */
/*  SECCIÓN DE VALORACIONES */
/* ====================== */

$ratingFeedback = '';
if (isset($_POST['submit_rating'])) {
    if (isset($_POST['rating']) && isset($_SESSION['usuario'])) {
        $rating = intval($_POST['rating']);
        $usuario = $conn->real_escape_string($_SESSION['usuario']);
        
        // Verificar si el usuario ya votó
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

/* ====================== */
/*  SECCIÓN DE COMENTARIOS */
/* ====================== */

$commentFeedback = '';
if (isset($_POST['enviar_comentario'])) {
    if (isset($_SESSION['usuario'])) {
        $comentario = $conn->real_escape_string($_POST['comentario']);
        $usuario = $conn->real_escape_string($_SESSION['usuario']);
        $conn->query("INSERT INTO comentarios (id_post, nombre, comentario) VALUES ($id, '$usuario', '$comentario')");
        $commentFeedback = 'success';
    } else {
        $commentFeedback = 'login_required';
    }
}

// Obtener comentarios existentes
$comentarios = $conn->query("SELECT * FROM comentarios WHERE id_post = $id ORDER BY fecha DESC");

/* ====================== */
/*  SECCIÓN DE CABECERA */
/* ====================== */

include 'header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="../css/blog_style_Mk2.css">
    <link rel="stylesheet" href="../css/posts-style.css">
    <link rel="stylesheet" href="../css/modals.css">
</head>
<body>

<!-- Contenedor principal -->
<div class="container">

    <!-- ====================== -->
    <!--  SECCIÓN DE CABECERA DEL POST -->
    <!-- ====================== -->
    <div class="post-header-container">
        <div class="post-header-content">
            <div class=".title-container">
                <h1><?php echo htmlspecialchars($post['titular']); ?></h1>
                <p class="post-excerpt"><?php echo htmlspecialchars($post['descripcion_corta']); ?></p>
                
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
        </div>
    </div>

    <!-- ====================== -->
    <!--  SECCIÓN DE CONTENIDO PRINCIPAL -->
    <!-- ====================== -->
    <div class="post-content-container">
        <article class="post-content">
            <?php echo $post['contenido']; ?>
        </article>
                <span class="category-tag"><?php echo htmlspecialchars($post['categoria']); ?></span>
    </div>


    <!-- ====================== -->
    <!--  SECCIÓN DE VALORACIÓN -->
    <!-- ====================== -->
    <div class="rating-section-container">
        <section class="rating-section">
            <h3>¿Qué te pareció este post?</h3>
            <form method="post" action="" class="rating-form" id="ratingForm">
                <div class="emoji-rating-options">
                    <?php 
                    $ratingOptions = [
                        1 => ['emoji' => '😞', 'title' => 'Muy malo'],
                        2 => ['emoji' => '🙁', 'title' => 'No me gustó'],
                        3 => ['emoji' => '😐', 'title' => 'Neutral'],
                        4 => ['emoji' => '😊', 'title' => 'Me gustó'],
                        5 => ['emoji' => '😍', 'title' => 'Excelente']
                    ];
                    
                    foreach ($ratingOptions as $value => $data): ?>
                        <input type="radio" id="rating-<?php echo $value; ?>" name="rating" value="<?php echo $value; ?>" style="display: none;">
                        <label for="rating-<?php echo $value; ?>" title="<?php echo $data['title']; ?>"><?php echo $data['emoji']; ?></label>
                    <?php endforeach; ?>
                </div>
                <input type="submit" name="submit_rating" value="Enviar valoración" class="rating-submit-btn">
            </form>
        </section>
    </div>

    <!-- ====================== -->
    <!--  SECCIÓN DE REFERENCIAS -->
    <!-- ====================== -->
    <?php if (!empty($post['referencia'])): ?>
    <div class="references-container">
        <div class="references-content">
            <h2>Referencias</h2>
            <p><?php echo htmlspecialchars($post['referencia']); ?></p>
        </div>
    </div>
    <?php endif; ?>

    <!-- ====================== -->
    <!--  SECCIÓN DE COMENTARIOS -->
    <!-- ====================== -->
    <div class="comments-container">
        <section class="comments-section">
            <h2>Comentarios</h2>

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
        </section>
    </div>
</div>

<!-- ====================== -->
<!--  VENTANAS MODALES -->
<!-- ====================== -->

<!-- Modal de valoración -->
<div class="modal-overlay" id="ratingModal">
    <div class="modal-content rating-modal">
        <h3 id="modalRatingTitle"></h3>
        <div class="modal-emoji" id="modalRatingEmoji"></div>
        <p id="modalRatingMessage"></p>
        <button class="modal-close-btn">Cerrar</button>
    </div>
</div>

<!-- Modal de comentarios -->
<div class="modal-overlay" id="commentModal">
    <div class="modal-content comment-modal">
        <h3 id="modalCommentTitle"></h3>
        <div class="modal-emoji" id="modalCommentEmoji"></div>
        <p id="modalCommentMessage"></p>
        <button class="modal-close-btn">Cerrar</button>
    </div>
</div>

<!-- ====================== -->
<!--  SCRIPTS JAVASCRIPT -->
<!-- ====================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Configuración de modales
    const modals = {
        rating: {
            element: document.getElementById('ratingModal'),
            title: document.getElementById('modalRatingTitle'),
            emoji: document.getElementById('modalRatingEmoji'),
            message: document.getElementById('modalRatingMessage'),
            types: {
                success: {
                    title: '¡Gracias por tu valoración!',
                    emoji: '😊',
                    message: 'Tu opinión es muy importante para nosotros.'
                },
                already_rated: {
                    title: 'Ya has valorado',
                    emoji: '⚠️',
                    message: 'Solo puedes valorar este post una vez.'
                },
                login_required: {
                    title: 'Acceso requerido',
                    emoji: '🔒',
                    message: 'Debes iniciar sesión para valorar.'
                }
            }
        },
        comment: {
            element: document.getElementById('commentModal'),
            title: document.getElementById('modalCommentTitle'),
            emoji: document.getElementById('modalCommentEmoji'),
            message: document.getElementById('modalCommentMessage'),
            types: {
                success: {
                    title: '¡Comentario publicado!',
                    emoji: '💬',
                    message: 'Tu comentario ha sido enviado con éxito.'
                },
                login_required: {
                    title: 'Acceso requerido',
                    emoji: '🔒',
                    message: 'Debes iniciar sesión para comentar.'
                }
            }
        }
    };

    // Funciones para manejar modales
    function showModal(modal, type) {
        const config = modal.types[type];
        if (config) {
            modal.title.textContent = config.title;
            modal.emoji.textContent = config.emoji;
            modal.message.textContent = config.message;
            modal.element.classList.add('active');
        }
    }

    function closeModal(modal) {
        modal.classList.remove('active');
    }

    // Cerrar modales al hacer clic en el botón o fuera
    document.querySelectorAll('.modal-overlay, .modal-close-btn').forEach(element => {
        element.addEventListener('click', function(e) {
            if (e.target === element || e.target.classList.contains('modal-close-btn')) {
                document.querySelectorAll('.modal-overlay').forEach(modal => {
                    closeModal(modal);
                });
            }
        });
    });

    // Manejar formulario de valoración
    const ratingForm = document.getElementById('ratingForm');
    if (ratingForm) {
        ratingForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const selectedRating = document.querySelector('input[name="rating"]:checked');
            
            if (!selectedRating && !<?php echo isset($_SESSION['usuario']) ? 'true' : 'false'; ?>) {
                showModal(modals.rating, 'login_required');
                return;
            } else if (!selectedRating) {
                alert('Por favor selecciona una valoración');
                return;
            }
            
            // Mostrar feedback inmediato
            showModal(modals.rating, 'success');
            
            // Enviar formulario después de 1.5 segundos
            setTimeout(() => {
                ratingForm.submit();
            }, 1500);
        });
    }

    // Manejar feedback de PHP
    <?php if ($ratingFeedback): ?>
        showModal(modals.rating, '<?php echo $ratingFeedback; ?>');
    <?php endif; ?>

    <?php if ($commentFeedback): ?>
        showModal(modals.comment, '<?php echo $commentFeedback; ?>');
    <?php endif; ?>
});
</script>

<?php
include 'footer.php';
$conn->close();
?>
<!-- Botón de scroll -->
<button id="scrollBtn">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
        <path fill="currentColor" d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"/>
    </svg>
</button>