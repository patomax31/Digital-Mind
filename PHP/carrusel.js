document.addEventListener('DOMContentLoaded', function() {
    // Cargar e inicializar el carrusel si existe el contenedor
    const carruselContainer = document.getElementById('carrusel-container');
    if (carruselContainer) {
        // Cargar el contenido del carrusel
        fetch('carrusel.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.text();
            })
            .then(html => {
                // Extraer solo el contenido relevante del carrusel
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const carruselContent = doc.querySelector('.image-section');
                
                if (carruselContent) {
                    carruselContainer.innerHTML = carruselContent.outerHTML;
                    // Inicializar el carrusel una vez cargado
                    initCarousel();
                } else {
                    console.error('No se encontró el contenido del carrusel');
                }
            })
            .catch(error => {
                console.error('Error al cargar el carrusel:', error);
                carruselContainer.innerHTML = '<p>Error al cargar el carrusel</p>';
            });
    } else {
        // Si estamos en una página que ya tiene el carrusel directamente en el HTML
        initCarousel();
    }
});

/**
 * Inicializa el carrusel con todas sus funcionalidades
 */
function initCarousel() {
    const carousel = document.querySelector('.carrusel');
    if (!carousel) return;
    
    const carouselImages = document.querySelector('.carousel-images');
    const prevButton = document.querySelector('.carousel-prev');
    const nextButton = document.querySelector('.carousel-next');
    const indicators = document.querySelector('.carousel-indicators');
    const textItems = document.querySelectorAll('.carousel-text-item');
    
    let currentIndex = 0;
    const totalImages = document.querySelectorAll('.carousel-item').length;
    
    // Crear indicadores dinámicamente
    for (let i = 0; i < totalImages; i++) {
        const indicator = document.createElement('div');
        indicator.classList.add('carousel-indicator');
        if (i === 0) indicator.classList.add('active');
        indicator.addEventListener('click', () => {
            currentIndex = i;
            updateCarousel();
        });
        indicators.appendChild(indicator);
    }
    
    // Función para actualizar el carrusel
    function updateCarousel() {
        // Actualizar posición del carrusel
        carouselImages.style.transform = `translateX(-${currentIndex * (100 / totalImages)}%)`;
        
        // Actualizar indicadores
        const indicatorDots = document.querySelectorAll('.carousel-indicator');
        indicatorDots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentIndex);
        });
        
        // Actualizar textos con reinicio de animación
        textItems.forEach((item, index) => {
            // Primero removemos la clase active de todos
            item.classList.remove('active');
            
            // Luego forzamos un reflow para reiniciar la animación
            if (index === currentIndex) {
                void item.offsetWidth; // Truco para forzar un reflow
                item.classList.add('active');
            }
        });
    }
    
    // Configurar botones de navegación
    prevButton.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + totalImages) % totalImages;
        updateCarousel();
    });
    
    nextButton.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % totalImages;
        updateCarousel();
    });
    
    // Auto-reproducción opcional
    let autoplayInterval;
    
    function startAutoplay() {
        autoplayInterval = setInterval(() => {
            currentIndex = (currentIndex + 1) % totalImages;
            updateCarousel();
        }, 5000); // Cambiar cada 5 segundos
    }
    
    function stopAutoplay() {
        clearInterval(autoplayInterval);
    }
    
    // Iniciar autoplay
    startAutoplay();
    
    // Detener autoplay al interactuar
    carousel.addEventListener('mouseenter', stopAutoplay);
    carousel.addEventListener('mouseleave', startAutoplay);
    
    // Asegurarse de que la primera imagen esté activa
    updateCarousel();
}
window.onload = function() {
    const images = document.querySelectorAll('.carousel-item img');
    images.forEach(img => {
      img.onload = () => {
        img.style.display = 'block';
      };
      img.onerror = () => {
        console.error(`Failed to load image: ${img.src}`);
      };
    });
  };
  document.querySelectorAll('.carousel-item img').forEach(img => {
    img.onload = () => console.log(`Cargada: ${img.src}`);
    img.onerror = () => console.error(`Error al cargar: ${img.src}`);
});

  