document.addEventListener('DOMContentLoaded', function() {
    // Función para inicializar el carrusel (sin cambios relevantes para el color)
    function initCarousel() {
        const carousel = document.querySelector('.carousel');
        const carouselImages = document.querySelector('.carousel-images');
        const images = document.querySelectorAll('.carousel-item');
        const indicators = document.querySelector('.carousel-indicators');
        const textItems = document.querySelectorAll('.carousel-text-item');

        if (!carousel || !carouselImages) return;

        let currentIndex = 0;
        const totalImages = images.length;

        if (indicators) {
            indicators.innerHTML = '';
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
            carouselImages.style.transform = `translateX(-${currentIndex * (100 / totalImages)}%)`;
            const indicatorDots = document.querySelectorAll('.carousel-indicator');
            indicatorDots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentIndex);
            });
            textItems.forEach((item, index) => {
                item.classList.toggle('active', index === currentIndex);
            });
        }

        function handleNavigation(href) {
            window.location.href = href;
        }

        const nextButton = document.querySelector('.carousel-next');
        if (nextButton) {
            nextButton.addEventListener('click', (e) => {
                e.stopPropagation();
                currentIndex = (currentIndex + 1) % totalImages;
                updateCarousel();
            });
        }

        const prevButton = document.querySelector('.carousel-prev');
        if (prevButton) {
            prevButton.addEventListener('click', (e) => {
                e.stopPropagation();
                currentIndex = (currentIndex - 1 + totalImages) % totalImages;
                updateCarousel();
            });
        }

        let autoSlideInterval = setInterval(() => {
            currentIndex = (currentIndex + 1) % totalImages;
            updateCarousel();
        }, 5000);

        carousel.addEventListener('mouseenter', () => {
            clearInterval(autoSlideInterval);
        });

        carousel.addEventListener('mouseleave', () => {
            autoSlideInterval = setInterval(() => {
                currentIndex = (currentIndex + 1) % totalImages;
                updateCarousel();
            }, 5000);
        });

        const carouselButtons = document.querySelectorAll('.carousel-button');
        carouselButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const href = this.getAttribute('href');
                const textItem = this.closest('.carousel-text-item');
                textItem.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
                setTimeout(() => {
                    handleNavigation(href);
                }, 300);
            });
        });

        updateCarousel();
    }

    // Función para inicializar los elementos de contenido y poner la primera letra de la primera palabra del título en mayúsculas
    function initContentItems() {
        const contentItems = document.querySelectorAll('.content-item');
        const seeMoreLinks = document.querySelectorAll('.see-more');

        function handleNavigation(href) {
            window.location.href = href;
        }

        contentItems.forEach(item => {
            // Poner la primera letra de la primera palabra del título en mayúsculas
            const titleElement = item.querySelector('.title');
            if (titleElement) {
                const words = titleElement.textContent.toLowerCase().split(' ');
                if (words.length > 0 && words[0].length > 0) {
                    words[0] = words[0].charAt(0).toUpperCase() + words[0].slice(1);
                    titleElement.textContent = words.join(' ');
                } else if (words.length > 0) {
                    titleElement.textContent = words.join(' ');
                }
            }
        });

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
        fetch('carrusel.html')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.text();
            })
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const carruselContent = doc.querySelector('.image-section');

                if (carruselContent) {
                    carruselContainer.innerHTML = carruselContent.outerHTML;
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

    // Llamar a la función para inicializar los títulos de los content-item
    initContentItems();
});
document.addEventListener('DOMContentLoaded', () => {
    const header = document.getElementById('slidingHeader');
    const body = document.body;
    let lastScrollY = window.scrollY;

    window.addEventListener('scroll', () => {
        const currentScrollY = window.scrollY;

        if (currentScrollY > lastScrollY) {
            // Cuando el usuario baja
            header.classList.add('slide-up');
            header.classList.remove('slide-down');
        } else {
            // Cuando el usuario sube
            header.classList.add('slide-down');
            header.classList.remove('slide-up');
        }

        lastScrollY = currentScrollY;
    });

    // Establecemos un margen superior en el body para acomodar el header ampliado
    body.style.marginTop = `${header.offsetHeight}px`;
});
// Barra de progreso
window.addEventListener('scroll', () => {
  const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
  const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  const scrolled = (winScroll / height) * 100;
  document.getElementById('progress').style.width = scrolled + '%';
});

