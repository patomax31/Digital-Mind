document.addEventListener('DOMContentLoaded', function() {
    const scrollBtn = document.getElementById('scrollBtn');
    
    // Verificar si el botón existe
    if (!scrollBtn) {
        console.error('El botón de scroll no fue encontrado');
        return;
    }

    // Mostrar/ocultar botón con scroll suave
    let isScrolling;
    window.addEventListener('scroll', function() {
        // Cancelar el timeout anterior
        window.clearTimeout(isScrolling);
        
        // Ocultar botón temporalmente durante el scroll
        scrollBtn.style.opacity = '0';
        scrollBtn.style.transition = 'opacity 0.2s';
        
        // Configurar timeout para mostrar después de que termine el scroll
        isScrolling = setTimeout(function() {
            if (window.scrollY > 300) { // Cambiado de 20 a 300 para mejor UX
                scrollBtn.style.display = 'flex';
                scrollBtn.style.opacity = '1';
            } else {
                scrollBtn.style.opacity = '0';
                // Ocultar completamente después de la transición
                setTimeout(() => {
                    scrollBtn.style.display = 'none';
                }, 200);
            }
        }, 100);
    }, false);

    // Scroll suave al hacer click
    scrollBtn.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Ocultar inicialmente
    scrollBtn.style.display = 'none';
    scrollBtn.style.opacity = '0';
});