<?php
// Conexión a la base de datos
include 'blog_db.php';

// Consulta para obtener los 5 posts más recientes para el carrusel
$sql_carousel = "SELECT * FROM publicaciones_2 WHERE estado = 'publicado' ORDER BY fecha_creacion DESC LIMIT 5";
$resultado_carousel = $conn->query($sql_carousel);

// Verificar si hay resultados
$slides = [];
if ($resultado_carousel->num_rows > 0) {
    while ($fila = $resultado_carousel->fetch_assoc()) {
        $slides[] = $fila;
    }
}
?>

<style>
.carousel-container {
    width: 95%;
    max-width: 1200px; /* Añadir un ancho máximo */
    position: relative;
    margin: 20px auto; /* Ajustar márgenes */
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

/* Modificar el título para que sea blanco */
.carousel-caption h2 {
    color: white; /* Añadir esta línea */
    margin: 0 0 10px 0;
    font-size: 28px;
    background-color: rgba(0, 0, 0, 0.7);
    padding: 5px;
    display: inline-block;
    border-radius: 5px;
}

.carousel-container:hover {
    transform: scale(1.02); /* Efecto de agrandar al pasar el cursor */
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
}

.carousel-slides {
    display: flex;
    width: 500%; /* 100% * número máximo de slides (5) */
    transition: transform 0.5s ease-in-out;
}

.carousel-slide {
    width: 20%; /* 100% / número máximo de slides (5) */
    position: relative;
    height: 600px; /* Aumentando la altura del slide */
}

.carousel-image {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Asegurando que la imagen cubra el contenedor */
}

.carousel-caption {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.8));
    color: white;
    padding: 20px;
}

.carousel-caption h2 {
    margin: 0 0 10px 0;
    font-size: 28px; /* Aumentando el tamaño del título */
    background-color: rgba(0, 0, 0, 0.7); /* Fondo negro para el título */
    padding: 5px;
    display: inline-block; /* Para que el fondo negro se ajuste al texto */
    border-radius: 5px; /* Opcional: bordes redondeados para el fondo del título */
}

.carousel-caption p {
    margin: 0;
    font-size: 16px;
}

.carousel-date {
    font-size: 14px;
    opacity: 0.8;
    margin-bottom: 10px;
    display: block;
}

.carousel-link {
    display: inline-block;
    margin-top: 10px;
    color: white;
    text-decoration: none;
    background-color: rgba(255, 255, 255, 0.2);
    padding: 8px 20px; /* Aumentando el padding del botón */
    border-radius: 25px; /* Haciendo los bordes más redondeados */
    transition: background-color 0.3s, transform 0.3s; /* Transiciones para el hover */
}

.carousel-link:hover {
    background-color: rgba(255, 255, 255, 0.4);
    transform: scale(1.1); /* Efecto de agrandar el botón al pasar el cursor */
}

.carousel-controls {
    position: absolute;
    top: 0;
    bottom: 0;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    pointer-events: none; /* Evita que los controles interfieran con el hover del contenedor */
}

.carousel-control {
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
    pointer-events: auto; /* Permite la interacción con los botones */
}

.carousel-control:hover {
    background-color: rgba(0, 0, 0, 0.7);
}

.carousel-indicators {
    position: absolute;
    bottom: 15px;
    left: 0;
    right: 0;
    display: flex;
    justify-content: center;
    gap: 10px;
}

.carousel-indicator {
    width: 12px;
    height: 12px;
    background-color: rgba(255, 255, 255, 0.5);
    border-radius: 50%;
    cursor: pointer;
    transition: background-color 0.3s;
}

.carousel-indicator.active {
    background-color: white;
}

@media (max-width: 768px) {
    .carousel-slide {
        height: 400px; /* Ajustando la altura en pantallas más pequeñas */
    }

    .carousel-caption h2 {
        font-size: 24px;
    }

    .carousel-caption p {
        font-size: 14px;
    }
}
</style>

<div class="carousel-container">
    <?php if (!empty($slides)): ?>
        <div class="carousel-slides" id="carouselSlides">
            <?php foreach ($slides as $index => $slide): ?>
                <div class="carousel-slide">
                    <?php
                    $imagen = !empty($slide['imagen'])
                        ? '../images/publicaciones/' . htmlspecialchars($slide['imagen'])
                        : '../images/escuela1.jpg';
                    ?>
                    <img src="<?php echo $imagen; ?>" alt="<?php echo htmlspecialchars($slide['titular']); ?>" class="carousel-image">

                    <div class="carousel-caption">
                        <h2><?php echo htmlspecialchars($slide['titular']); ?></h2>
                        <span class="carousel-date">Publicado el <?php echo date("d/m/Y", strtotime($slide['fecha'])); ?></span>
                        <p><?php echo htmlspecialchars(substr($slide['descripcion_corta'], 0, 120) . (strlen($slide['descripcion_corta']) > 120 ? '...' : '')); ?></p>
                        <a href="../PHP/post_completo.php?id=<?php echo $slide['id']; ?>" class="carousel-link">Ver más</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="carousel-controls">
            <button class="carousel-control" id="prevBtn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
                    <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
                </svg>
            </button>
            <button class="carousel-control" id="nextBtn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                </svg>
            </button>
        </div>

        <div class="carousel-indicators" id="carouselIndicators">
            <?php for ($i = 0; $i < count($slides); $i++): ?>
                <div class="carousel-indicator <?php echo $i === 0 ? 'active' : ''; ?>" data-index="<?php echo $i; ?>"></div>
            <?php endfor; ?>
        </div>
    <?php else: ?>
        <div class="carousel-empty">
            <p>No hay publicaciones disponibles para mostrar en el carrusel.</p>
        </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.getElementById('carouselSlides');
    const indicators = document.querySelectorAll('.carousel-indicator');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const carouselContainer = document.querySelector('.carousel-container');
    let currentIndex = 0;
    const slideCount = <?php echo count($slides); ?>;

    if (slideCount === 0) return;

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

    showSlide(0);
});
</script>
<?php $conn->close(); ?>