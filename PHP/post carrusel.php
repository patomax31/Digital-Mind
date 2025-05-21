<?php
// Conexión a la base de datos
include 'blog_db.php';

// Obtener el ID del post actual
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Consulta para obtener 4 posts aleatorios (excluyendo el actual)
$sql_random = "SELECT * FROM publicaciones_2 WHERE id != ? ORDER BY RAND() LIMIT 4";
$stmt_random = $conn->prepare($sql_random);
$stmt_random->bind_param("i", $post_id);
$stmt_random->execute();
$result_random = $stmt_random->get_result();

$random_posts = [];
if ($result_random->num_rows > 0) {
    while ($row = $result_random->fetch_assoc()) {
        $random_posts[] = $row;
    }
}
?>

<!-- Tus secciones existentes (post, referencias) -->

<!-- Carrusel "Podría interesarte" -->
<div class="related-posts-container">
    <h3 class="related-title">Podría interesarte</h3>
    
    <div class="related-posts-carousel">
        <?php if (!empty($random_posts)): ?>
            <?php foreach ($random_posts as $post): ?>
                <div class="related-post">
                    <a href="post_completo.php?id=<?= $post['id'] ?>">
                        <div class="related-post-image">
                            <img src="<?= !empty($post['imagen']) ? '../images/publicaciones/' . htmlspecialchars($post['imagen']) : '../images/escuela1.jpg' ?>" alt="<?= htmlspecialchars($post['titular']) ?>">
                        </div>
                        <div class="related-post-content">
                            <h4><?= htmlspecialchars($post['titular']) ?></h4>
                            <p class="related-post-excerpt"><?= htmlspecialchars(substr($post['descripcion_corta'], 0, 100)) ?>...</p>
                            <span class="related-post-date"><?= date("d/m/Y", strtotime($post['fecha'])) ?></span>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay publicaciones relacionadas disponibles.</p>
        <?php endif; ?>
    </div>
    
    <div class="carousel-controls">
        <button class="carousel-prev">‹</button>
        <button class="carousel-next">›</button>
    </div>
</div>

<!-- Tus secciones existentes (comentarios) -->

<style>
/* Estilos para el carrusel "Podría interesarte" */
.related-posts-container {
    margin: 40px 0;
    padding: 20px 0;
    border-top: 1px solid #eaeaea;
    border-bottom: 1px solid #eaeaea;
}

.related-title {
    text-align: center;
    margin-bottom: 25px;
    color: #2c3e50;
    font-size: 1.5rem;
    position: relative;
}

.related-title:after {
    content: '';
    display: block;
    width: 60px;
    height: 3px;
    background: #4a6e82;
    margin: 10px auto 0;
}

.related-posts-carousel {
    display: flex;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
    margin-bottom: 20px;
    padding-bottom: 10px;
    gap: 20px;
}

.related-post {
    flex: 0 0 calc(33.333% - 20px);
    scroll-snap-align: start;
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.related-post:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.related-post a {
    text-decoration: none;
    color: inherit;
}

.related-post-image {
    height: 180px;
    overflow: hidden;
}

.related-post-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.related-post:hover .related-post-image img {
    transform: scale(1.05);
}

.related-post-content {
    padding: 15px;
}

.related-post-content h4 {
    margin: 0 0 10px;
    font-size: 1.1rem;
    color: #2c3e50;
    line-height: 1.3;
}

.related-post-excerpt {
    color: #666;
    font-size: 0.9rem;
    margin: 0 0 10px;
    line-height: 1.4;
}

.related-post-date {
    color: #888;
    font-size: 0.8rem;
    display: block;
}

.carousel-controls {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 15px;
}

.carousel-prev, .carousel-next {
    background: #4a6e82;
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 1.2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s ease;
}

.carousel-prev:hover, .carousel-next:hover {
    background: #2c3e50;
}

/* Responsive */
@media (max-width: 768px) {
    .related-post {
        flex: 0 0 calc(50% - 15px);
    }
}

@media (max-width: 480px) {
    .related-post {
        flex: 0 0 100%;
    }
    
    .related-post-image {
        height: 150px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('.related-posts-carousel');
    const prevBtn = document.querySelector('.carousel-prev');
    const nextBtn = document.querySelector('.carousel-next');
    const posts = document.querySelectorAll('.related-post');
    const postWidth = posts[0] ? posts[0].offsetWidth + 20 : 300; // Ancho del post + gap
    
    if (posts.length > 0) {
        let currentPosition = 0;
        
        function updateButtons() {
            prevBtn.disabled = currentPosition >= 0;
            nextBtn.disabled = currentPosition <= -(posts.length * postWidth - carousel.offsetWidth);
        }
        
        prevBtn.addEventListener('click', function() {
            currentPosition += postWidth * 2;
            if (currentPosition > 0) currentPosition = 0;
            carousel.scrollTo({
                left: -currentPosition,
                behavior: 'smooth'
            });
            updateButtons();
        });
        
        nextBtn.addEventListener('click', function() {
            currentPosition -= postWidth * 2;
            const maxScroll = carousel.scrollWidth - carousel.offsetWidth;
            if (-currentPosition > maxScroll) currentPosition = -maxScroll;
            carousel.scrollTo({
                left: -currentPosition,
                behavior: 'smooth'
            });
            updateButtons();
        });
        
        // Inicializar estado de los botones
        updateButtons();
        
        // Opcional: Auto-scroll cada 5 segundos
        let autoScroll = setInterval(() => {
            if (!nextBtn.disabled) {
                nextBtn.click();
            } else {
                currentPosition = 0;
                carousel.scrollTo({
                    left: 0,
                    behavior: 'smooth'
                });
                updateButtons();
            }
        }, 5000);
        
        // Pausar auto-scroll al interactuar
        carousel.addEventListener('mouseenter', () => clearInterval(autoScroll));
        carousel.addEventListener('mouseleave', () => {
            autoScroll = setInterval(() => {
                if (!nextBtn.disabled) {
                    nextBtn.click();
                } else {
                    currentPosition = 0;
                    carousel.scrollTo({
                        left: 0,
                        behavior: 'smooth'
                    });
                    updateButtons();
                }
            }, 5000);
        });
    } else {
        prevBtn.style.display = 'none';
        nextBtn.style.display = 'none';
    }
});
</script>