<?php
// Verificar que la conexión existe antes de usarla
if (!file_exists('blog_db.php')) {
    die("Error: El archivo de conexión 'blog_db.php' no existe.");
}

// Conexión a la base de datos
include 'blog_db.php';

// Verificar que la conexión se estableció correctamente
if (!isset($conn)) {
    die("Error: No se pudo establecer la conexión a la base de datos.");
}

// Verificar que la conexión no tenga errores
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener los 5 posts más recientes para el carrusel
$sql_carousel = "SELECT id, titular, descripcion_corta, imagen, fecha_creacion, fecha FROM publicaciones_2 WHERE estado = 'publicado' ORDER BY fecha_creacion DESC LIMIT 5";
$resultado_carousel = $conn->query($sql_carousel);

// Verificar si la consulta fue exitosa
if (!$resultado_carousel) {
    die("Error en la consulta: " . $conn->error);
}

// Verificar si hay resultados
$slides = [];
if ($resultado_carousel->num_rows > 0) {
    while ($fila = $resultado_carousel->fetch_assoc()) {
        $slides[] = $fila;
    }
}
?>

<style>
.dynamic-carousel-container {
    width: 95%;
    max-width: 1200px;
    position: relative;
    margin: 20px auto;
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.dynamic-carousel-container:hover {
    transform: scale(1.02);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
}

.dynamic-carousel-slides {
    display: flex;
    width: 500%;
    transition: transform 0.5s ease-in-out;
}

.dynamic-carousel-slide {
    width: 20%;
    position: relative;
    height: 600px;
    flex-shrink: 0;
}

.dynamic-carousel-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.dynamic-carousel-caption {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.8));
    color: white;
    padding: 20px;
}

.dynamic-carousel-caption h2 {
    color: white;
    margin: 0 0 10px 0;
    font-size: 28px;
    background-color: rgba(0, 0, 0, 0.7);
    padding: 5px;
    display: inline-block;
    border-radius: 5px;
}

.dynamic-carousel-caption p {
    margin: 0;
    font-size: 16px;
}

.dynamic-carousel-date {
    font-size: 14px;
    opacity: 0.8;
    margin-bottom: 10px;
    display: block;
}

.dynamic-carousel-link {
    display: inline-block;
    margin-top: 10px;
    color: white;
    text-decoration: none;
    background-color: rgba(255, 255, 255, 0.2);
    padding: 8px 20px;
    border-radius: 25px;
    transition: background-color 0.3s, transform 0.3s;
}

.dynamic-carousel-link:hover {
    background-color: rgba(255, 255, 255, 0.4);
    transform: scale(1.1);
}

.dynamic-carousel-controls {
    position: absolute;
    top: 0;
    bottom: 0;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    pointer-events: none;
}

.dynamic-carousel-control {
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    margin: 0 15px;
    transition: background-color 0.3s;
    pointer-events: auto;
}

.dynamic-carousel-control:hover {
    background-color: rgba(0, 0, 0, 0.7);
}

.dynamic-carousel-indicators {
    position: absolute;
    bottom: 15px;
    left: 0;
    right: 0;
    display: flex;
    justify-content: center;
    gap: 10px;
}

.dynamic-carousel-indicator {
    width: 12px;
    height: 12px;
    background-color: rgba(255, 255, 255, 0.5);
    border-radius: 50%;
    cursor: pointer;
    transition: background-color 0.3s;
}

.dynamic-carousel-indicator.active {
    background-color: white;
}

.dynamic-carousel-empty {
    padding: 40px;
    text-align: center;
    background-color: #f8f9fa;
    border-radius: 15px;
}

.dynamic-carousel-empty p {
    margin: 0;
    color: #6c757d;
    font-size: 18px;
}

@media (max-width: 768px) {
    .dynamic-carousel-slide {
        height: 400px;
    }

    .dynamic-carousel-caption h2 {
        font-size: 24px;
    }

    .dynamic-carousel-caption p {
        font-size: 14px;
    }
}
</style>

<div class="dynamic-carousel-container">
    <?php if (!empty($slides)): ?>
        <div class="dynamic-carousel-slides" id="dynamicCarouselSlides">
            <?php foreach ($slides as $index => $slide): ?>
                <div class="dynamic-carousel-slide">
                    <?php
                    $imagen = !empty($slide['imagen'])
                        ? '../images/publicaciones/' . htmlspecialchars($slide['imagen'])
                        : '../images/escuela1.jpg';
                    ?>
                    <img src="<?php echo $imagen; ?>" alt="<?php echo htmlspecialchars($slide['titular']); ?>" class="dynamic-carousel-image">

                    <div class="dynamic-carousel-caption">
                        <h2><?php echo htmlspecialchars($slide['titular']); ?></h2>
                        <span class="dynamic-carousel-date">
                            Publicado el <?php echo date("d/m/Y", strtotime($slide['fecha_creacion'])); ?>
                        </span>
                        <p><?php echo htmlspecialchars(substr($slide['descripcion_corta'], 0, 120) . (strlen($slide['descripcion_corta']) > 120 ? '...' : '')); ?></p>
                        <a href="../PHP/post_completo.php?id=<?php echo $slide['id']; ?>" class="dynamic-carousel-link">Ver más</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="dynamic-carousel-controls">
            <button class="dynamic-carousel-control" id="dynamicPrevBtn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
                    <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
                </svg>
            </button>
            <button class="dynamic-carousel-control" id="dynamicNextBtn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                </svg>
            </button>
        </div>

        <div class="dynamic-carousel-indicators" id="dynamicCarouselIndicators">
            <?php for ($i = 0; $i < count($slides); $i++): ?>
                <div class="dynamic-carousel-indicator <?php echo $i === 0 ? 'active' : ''; ?>" data-dynamic-index="<?php echo $i; ?>"></div>
            <?php endfor; ?>
        </div>
    <?php else: ?>
        <div class="dynamic-carousel-empty">
            <p>No hay publicaciones disponibles para mostrar en el carrusel.</p>
        </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Variables específicas del carrusel dinámico para evitar conflictos
    const dynamicSlides = document.getElementById('dynamicCarouselSlides');
    const dynamicIndicators = document.querySelectorAll('.dynamic-carousel-indicator');
    const dynamicPrevBtn = document.getElementById('dynamicPrevBtn');
    const dynamicNextBtn = document.getElementById('dynamicNextBtn');
    const dynamicCarouselContainer = document.querySelector('.dynamic-carousel-container');
    
    let dynamicCurrentIndex = 0;
    const dynamicSlideCount = <?php echo count($slides); ?>;
    let dynamicInterval;

    // Verificar que existen elementos antes de continuar
    if (!dynamicSlides || dynamicSlideCount === 0) return;

    function showDynamicSlide(index) {
        // Corregir el índice si está fuera de rango
        if (index < 0) index = dynamicSlideCount - 1;
        if (index >= dynamicSlideCount) index = 0;

        dynamicCurrentIndex = index;
        
        // Transformación: cada slide ocupa 20% del ancho total (100% / 5 slides)
        const translateX = -dynamicCurrentIndex * 20;
        dynamicSlides.style.transform = `translateX(${translateX}%)`;

        // Actualizar indicadores
        dynamicIndicators.forEach((indicator, i) => {
            indicator.classList.remove('active');
            if (i === dynamicCurrentIndex) {
                indicator.classList.add('active');
            }
        });
    }

    // Event listeners para los botones de control
    if (dynamicPrevBtn) {
        dynamicPrevBtn.addEventListener('click', function(e) {
            e.preventDefault();
            showDynamicSlide(dynamicCurrentIndex - 1);
        });
    }

    if (dynamicNextBtn) {
        dynamicNextBtn.addEventListener('click', function(e) {
            e.preventDefault();
            showDynamicSlide(dynamicCurrentIndex + 1);
        });
    }

    // Event listeners para los indicadores
    dynamicIndicators.forEach((indicator, index) => {
        indicator.addEventListener('click', function(e) {
            e.preventDefault();
            showDynamicSlide(index);
        });
    });

    // Función para iniciar auto-play
    function startDynamicAutoplay() {
        dynamicInterval = setInterval(() => {
            showDynamicSlide(dynamicCurrentIndex + 1);
        }, 5000);
    }

    // Función para detener auto-play
    function stopDynamicAutoplay() {
        if (dynamicInterval) {
            clearInterval(dynamicInterval);
        }
    }

    // Control de auto-play con hover
    if (dynamicCarouselContainer) {
        dynamicCarouselContainer.addEventListener('mouseenter', stopDynamicAutoplay);
        dynamicCarouselContainer.addEventListener('mouseleave', startDynamicAutoplay);
    }

    // Inicializar carrusel
    showDynamicSlide(0);
    startDynamicAutoplay();
});
</script>

<?php 
// Cerrar la conexión solo si existe
if (isset($conn)) {
    $conn->close(); 
}
?>