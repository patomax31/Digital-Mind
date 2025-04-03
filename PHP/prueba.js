document.addEventListener('DOMContentLoaded', function() {
    // Función para inicializar el carrusel
    function initCarousel() {
        const carousel = document.querySelector('.carousel');
        const carouselImages = document.querySelector('.carousel-images');
        const images = document.querySelectorAll('.carousel-item');
        const indicators = document.querySelector('.carousel-indicators');
        const textItems = document.querySelectorAll('.carousel-text-item');
        const contentItems = document.querySelectorAll('.content-item');
        
        // Si no existe el carrusel en la página actual, no continuar
        if (!carousel || !carouselImages) return;
        
        let currentIndex = 0;
        const totalImages = images.length;
        
        // Limpiar indicadores existentes
        if (indicators) {
            indicators.innerHTML = '';
            
            // Crear indicadores
            images.forEach((_, index) => {
                const indicator = document.createElement('div');
                indicator.classList.add('carousel-indicator');
                if (index === 0) indicator.classList.add('active');
                indicator.addEventListener('click', () => {
                    currentIndex = index;
                    updateCarousel();
                });
                indicators.appendChild(indicator);
            });
        }
        
        function updateCarousel() {
            // Actualizar posición del carrusel
            carouselImages.style.transform = `translateX(-${currentIndex * (100 / totalImages)}%)`;
            
            // Actualizar indicadores
            const indicatorDots = document.querySelectorAll('.carousel-indicator');
            indicatorDots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentIndex);
            });
            
            // Actualizar textos
            textItems.forEach((item, index) => {
                item.classList.toggle('active', index === currentIndex);
            });
        }
        
        // Función para manejar navegación
        function handleNavigation(href) {
            window.location.href = href;
        }
        
        const nextButton = document.querySelector('.carousel-next');
        if (nextButton) {
            nextButton.addEventListener('click', (e) => {
                e.stopPropagation(); // Evitar propagación del evento
                currentIndex = (currentIndex + 1) % totalImages;
                updateCarousel();
            });
        }
        
        const prevButton = document.querySelector('.carousel-prev');
        if (prevButton) {
            prevButton.addEventListener('click', (e) => {
                e.stopPropagation(); // Evitar propagación del evento
                currentIndex = (currentIndex - 1 + totalImages) % totalImages;
                updateCarousel();
            });
        }
        
        // Auto-avance del carrusel
        let autoSlideInterval = setInterval(() => {
            currentIndex = (currentIndex + 1) % totalImages;
            updateCarousel();
        }, 5000);
        
        // Pausar auto-avance al pasar el mouse
        carousel.addEventListener('mouseenter', () => {
            clearInterval(autoSlideInterval);
        });
        
        carousel.addEventListener('mouseleave', () => {
            autoSlideInterval = setInterval(() => {
                currentIndex = (currentIndex + 1) % totalImages;
                updateCarousel();
            }, 5000);
        });
        
        // Manejar clics en los botones del carrusel
        const carouselButtons = document.querySelectorAll('.carousel-button');
        carouselButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation(); // Evitar que el evento se propague
                
                // Guardar la URL antes de aplicar efectos
                const href = this.getAttribute('href');
                
                // Aplicar efecto visual
                const textItem = this.closest('.carousel-text-item');
                textItem.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
                
                // Navegar después del efecto
                setTimeout(() => {
                    handleNavigation(href);
                }, 300);
            });
        });
        
        // Asegurar que el estado inicial es correcto
        updateCarousel();
    }
    function initContentItems() {
        const contentItems = document.querySelectorAll('.content-item');
        const seeMoreLinks = document.querySelectorAll('.see-more');
        
        function handleNavigation(href) {
            window.location.href = href;
        }
        seeMoreLinks.forEach((link) => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                contentItems.forEach(item => {
                    item.classList.remove('selected');
                });
                const parentItem = this.closest('.content-item');
                if (parentItem) {
                    parentItem.classList.add('selected');
                }
                const href = this.getAttribute('href');
                setTimeout(() => {
                    handleNavigation(href);
                }, 500);
            });
        });
    }
    const carruselContainer = document.getElementById('carrusel-container');
    if (carruselContainer) {
        // Cargar el contenido del carrusel
        fetch('carrusel.html')
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
        initCarousel();
    }
    initContentItems();
});
