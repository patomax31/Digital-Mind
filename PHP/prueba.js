document.addEventListener('DOMContentLoaded', function() {
    // Inicializar el header deslizante
    const slidingHeader = document.getElementById('slidingHeader');
    
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
    
    initContentItems();
    initProgressBar();
    initScrollBtn();
    initSearchBar();
});

function initProgressBar() {
    const progressBar = document.getElementById('progress');
    
    if (!progressBar) return;
    
    window.addEventListener('scroll', function() {
        // Calcula qué porcentaje de la página se ha desplazado
        const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
        const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrollPercent = (scrollTop / scrollHeight) * 100;
        
        // Actualiza el ancho de la barra de progreso
        progressBar.style.width = scrollPercent + '%';
    });
}

function initScrollBtn() {
    const scrollBtn = document.getElementById('scrollBtn');
    
    if (!scrollBtn) return;
    
    // Mostrar u ocultar el botón según la posición de desplazamiento
    window.addEventListener('scroll', function() {
        const scrollPosition = window.scrollY || document.documentElement.scrollTop;
        
        if (scrollPosition > 300) {
            scrollBtn.classList.add('visible');
        } else {
            scrollBtn.classList.remove('visible');
        }
    });
    
    // Acción al hacer clic en el botón
    scrollBtn.addEventListener('click', function() {
        // Desplazamiento suave hacia arriba
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

function initSearchBar() {
    const pillSearch = document.querySelector('.pill-search');
    const searchInput = document.querySelector('.search-input');
    
    if (!pillSearch || !searchInput) return;
    
    // Expandir al hacer clic en la píldora
    pillSearch.addEventListener('click', function() {
        if (!this.classList.contains('expanded')) {
            this.classList.add('expanded');
            setTimeout(() => {
                searchInput.focus();
            }, 300);
        }
    });
    
    // Contraer cuando pierde el foco y está vacío
    searchInput.addEventListener('blur', function() {
        if (this.value.trim() === '') {
            pillSearch.classList.remove('expanded');
        }
    });
    
    // Evitar que se contraiga cuando se hace clic en el input
    searchInput.addEventListener('click', function(e) {
        e.stopPropagation();
    });
}