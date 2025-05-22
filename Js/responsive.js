/**
 * responsive.js - Script para adaptación dinámica según resolución de pantalla
 * DIGITALMIND - Sistema de detección y adaptación responsive
 */

// Ejecutar cuando el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar la detección responsive
    initResponsiveDetection();
    
    // Ejecutar cada vez que se redimensione la ventana
    window.addEventListener('resize', debounce(function() {
        applyResponsiveChanges();
    }, 250));
    
    // Ejecutar en la carga inicial
    applyResponsiveChanges();
});

/**
 * Función para inicializar la detección responsive
 */
function initResponsiveDetection() {
    // Crear elemento para mostrar información de depuración (opcional, se puede eliminar en producción)
    const debugElement = document.createElement('div');
    debugElement.id = 'responsive-debug';
    debugElement.style.cssText = 'position:fixed; bottom:10px; right:10px; background:rgba(0,0,0,0.7); color:white; padding:5px 10px; font-size:12px; z-index:9999; border-radius:4px; display:none;';
    document.body.appendChild(debugElement);
    
    // Botón para mostrar/ocultar información de depuración (opcional)
    const debugToggle = document.createElement('button');
    debugToggle.textContent = 'Debug Info';
    debugToggle.style.cssText = 'position:fixed; bottom:10px; right:10px; background:#007bff; color:white; padding:5px 10px; font-size:12px; z-index:10000; border:none; border-radius:4px; cursor:pointer;';
    debugToggle.addEventListener('click', function() {
        const debugEl = document.getElementById('responsive-debug');
        if (debugEl.style.display === 'none') {
            debugEl.style.display = 'block';
            updateDebugInfo();
        } else {
            debugEl.style.display = 'none';
        }
    });
    document.body.appendChild(debugToggle);
}

/**
 * Función principal para aplicar cambios basados en la resolución de pantalla
 */
function applyResponsiveChanges() {
    // Obtener dimensiones actuales
    const width = window.innerWidth;
    const height = window.innerHeight;
    const devicePixelRatio = window.devicePixelRatio || 1;
    
    // Actualizar información de depuración
    updateDebugInfo();
    
    // Determinar el tipo de dispositivo basado en el ancho
    const deviceType = getDeviceType(width);
    
    // Añadir clase al body para identificar tipo de dispositivo
    document.body.classList.remove('device-mobile', 'device-tablet', 'device-desktop', 'device-large');
    document.body.classList.add('device-' + deviceType);
    
    // Aplicar optimizaciones específicas según tipo de dispositivo
    applyDeviceSpecificOptimizations(deviceType, width, height);
    
    // Ajustar tamaños de imagen según densidad de píxeles
    optimizeImagesForPixelDensity(devicePixelRatio);
    
    // Ajustar el menú según el dispositivo
    adjustMenuByDevice(deviceType);
    
    // Ajustar tipografía responsive
    adjustResponsiveTypography(width);
    
    // Ajustar altura del carrusel proporcionalmente
    adjustCarouselHeight(width);
    
    // Optimizar disposición de los elementos de contenido
    optimizeContentLayout(width);
    
    console.log(`Responsive changes applied for ${deviceType} (${width}x${height}, DPR: ${devicePixelRatio})`);
}

/**
 * Determina el tipo de dispositivo según el ancho de pantalla
 */
function getDeviceType(width) {
    if (width < 768) {
        return 'mobile';
    } else if (width < 992) {
        return 'tablet';
    } else if (width < 1200) {
        return 'desktop';
    } else {
        return 'large';
    }
}

/**
 * Aplica optimizaciones específicas según el tipo de dispositivo
 */
function applyDeviceSpecificOptimizations(deviceType, width, height) {
    const header = document.querySelector('.sliding-header');
    const logo = document.querySelector('.logo img');
    const container = document.querySelector('.container');
    
    switch (deviceType) {
        case 'mobile':
            // Ajustes para móviles
            if (header) header.style.height = '60px';
            if (logo) {
                logo.style.maxHeight = '40px';
                logo.style.maxWidth = '160px';
            }
            if (container) container.style.paddingTop = '70px';
            
            // Simplificar elementos en móvil
            simplifyForMobile();
            break;
            
        case 'tablet':
            // Ajustes para tablets
            if (header) header.style.height = '70px';
            if (logo) {
                logo.style.maxHeight = '50px';
                logo.style.maxWidth = '200px';
            }
            if (container) container.style.paddingTop = '80px';
            
            // Restaurar elementos que fueron simplificados
            restoreFromMobile();
            break;
            
        case 'desktop':
        case 'large':
            // Ajustes para escritorio
            if (header) header.style.height = '80px';
            if (logo) {
                logo.style.maxHeight = '60px';
                logo.style.maxWidth = '300px';
            }
            if (container) container.style.paddingTop = '100px';
            
            // Restaurar elementos que fueron simplificados
            restoreFromMobile();
            break;
    }
}

/**
 * Simplifica elementos para visualización en dispositivos móviles
 */
function simplifyForMobile() {
    // Ocultar elementos no esenciales en móvil
    const nonEssentialElements = document.querySelectorAll('.non-essential');
    nonEssentialElements.forEach(element => {
        element.dataset.originalDisplay = element.style.display;
        element.style.display = 'none';
    });
    
    // Reducir padding y margin para contenido móvil
    const contentItems = document.querySelectorAll('.content-item');
    contentItems.forEach(item => {
        item.style.padding = '10px';
        item.style.marginBottom = '15px';
    });
    
    // Mostrar menú móvil y ocultar menú de escritorio
    const desktopMenu = document.querySelector('.header-actions');
    const mobileMenuToggle = document.getElementById('menuToggle');
    
    if (desktopMenu) {
        desktopMenu.dataset.originalDisplay = desktopMenu.style.display;
        desktopMenu.style.display = 'none';
    }
    
    if (mobileMenuToggle) {
        mobileMenuToggle.style.display = 'block';
    }
}

/**
 * Restaura elementos que fueron simplificados para móvil
 */
function restoreFromMobile() {
    // Restaurar elementos no esenciales
    const nonEssentialElements = document.querySelectorAll('.non-essential');
    nonEssentialElements.forEach(element => {
        if (element.dataset.originalDisplay) {
            element.style.display = element.dataset.originalDisplay;
        } else {
            element.style.display = '';
        }
    });
    
    // Restaurar padding y margin para contenido
    const contentItems = document.querySelectorAll('.content-item');
    contentItems.forEach(item => {
        item.style.padding = '';
        item.style.marginBottom = '';
    });
    
    // Mostrar menú de escritorio y ocultar menú móvil
    const desktopMenu = document.querySelector('.header-actions');
    const mobileMenuToggle = document.getElementById('menuToggle');
    
    if (desktopMenu && desktopMenu.dataset.originalDisplay) {
        desktopMenu.style.display = desktopMenu.dataset.originalDisplay;
    } else if (desktopMenu) {
        desktopMenu.style.display = '';
    }
    
    if (mobileMenuToggle) {
        mobileMenuToggle.style.display = '';
    }
}

/**
 * Optimiza las imágenes según la densidad de píxeles del dispositivo
 */
function optimizeImagesForPixelDensity(devicePixelRatio) {
    const images = document.querySelectorAll('img:not([data-responsive-processed])');
    
    images.forEach(img => {
        // Marcar la imagen como procesada para evitar procesarla nuevamente
        img.dataset.responsiveProcessed = 'true';
        
        // Solo procesar si la imagen tiene un src original
        if (!img.dataset.originalSrc) {
            img.dataset.originalSrc = img.src;
            
            // Solo si no es una imagen de placeholder (en un sitio real)
            if (!img.src.includes('placeholder') && !img.src.includes('data:image')) {
                // Determinar la calidad de imagen según densidad de píxeles
                let quality = 'medium';
                if (devicePixelRatio >= 2) {
                    quality = 'high';
                } else if (devicePixelRatio < 1) {
                    quality = 'low';
                }
                
                // Aquí podrías construir URLs diferentes para diferentes calidades
                // Por ejemplo: image.jpg -> image-high.jpg, image-medium.jpg, image-low.jpg
                const srcParts = img.dataset.originalSrc.split('.');
                const extension = srcParts.pop();
                const baseSrc = srcParts.join('.');
                
                // En un entorno real, cambiarías la URL a la versión apropiada
                // img.src = `${baseSrc}-${quality}.${extension}`;
                
                // Para este ejemplo, solo añadimos un parámetro de calidad a la URL
                // img.src = `${img.dataset.originalSrc}?quality=${quality}`;
            }
        }
    });
}

/**
 * Ajusta el menú según el dispositivo
 */
function adjustMenuByDevice(deviceType) {
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    
    if (!menuToggle || !sidebar) return;
    
    // Cerrar menú lateral en dispositivos móviles cuando se cambia el tamaño
    if (deviceType !== 'mobile' && sidebar.classList.contains('active')) {
        sidebar.classList.remove('active');
        document.getElementById('overlay')?.classList.remove('active');
    }
    
    // Ajustar ancho del sidebar según dispositivo
    switch (deviceType) {
        case 'mobile':
            sidebar.style.width = '85%';
            break;
        case 'tablet':
            sidebar.style.width = '350px';
            break;
        case 'desktop':
        case 'large':
            sidebar.style.width = '300px';
            break;
    }
}

/**
 * Ajusta la tipografía de manera responsive
 */
function adjustResponsiveTypography(width) {
    const fontSizeBase = width < 768 ? 14 : width < 992 ? 15 : 16;
    document.documentElement.style.fontSize = `${fontSizeBase}px`;
    
    // Ajustar tamaños de títulos específicamente
    const titles = document.querySelectorAll('.title');
    titles.forEach(title => {
        if (width < 768) {
            title.style.fontSize = '1.3em';
        } else if (width < 992) {
            title.style.fontSize = '1.5em';
        } else {
            title.style.fontSize = '1.8em';
        }
    });
}

/**
 * Ajusta la altura del carrusel proporcionalmente
 */
function adjustCarouselHeight(width) {
    const carousel = document.querySelector('.carousel-container');
    if (!carousel) return;
    
    // Establecer altura proporcional al ancho
    const aspectRatio = 0.5; // Ratio altura/ancho
    const carouselHeight = width * aspectRatio;
    
    // Limitar altura máxima en pantallas grandes
    const maxHeight = 500;
    const finalHeight = Math.min(carouselHeight, maxHeight);
    
    carousel.style.height = `${finalHeight}px`;
}

/**
 * Optimiza la disposición de los elementos de contenido
 */
function optimizeContentLayout(width) {
    const contentItems = document.querySelectorAll('.content-item');
    
    contentItems.forEach(item => {
        const image = item.querySelector('.content-image');
        const text = item.querySelector('.content-text');
        
        if (!image || !text) return;
        
        if (width < 768) {
            // Diseño vertical para móviles
            item.style.flexDirection = 'column';
            image.style.width = '100%';
            image.style.marginRight = '0';
            image.style.marginBottom = '15px';
        } else {
            // Diseño horizontal para tablets y superiores
            item.style.flexDirection = 'row';
            image.style.marginBottom = '0';
            
            // Ajustar ancho de imagen según dispositivo
            if (width < 992) {
                image.style.width = '30%';
                image.style.marginRight = '20px';
            } else {
                image.style.width = '325px';
                image.style.marginRight = '40px';
            }
        }
    });
}

/**
 * Actualiza la información de depuración
 */
function updateDebugInfo() {
    const debugElement = document.getElementById('responsive-debug');
    if (!debugElement) return;
    
    const width = window.innerWidth;
    const height = window.innerHeight;
    const devicePixelRatio = window.devicePixelRatio || 1;
    const deviceType = getDeviceType(width);
    
    debugElement.innerHTML = `
        <div>Resolución: ${width}x${height}</div>
        <div>DPR: ${devicePixelRatio}</div>
        <div>Dispositivo: ${deviceType}</div>
    `;
}

/**
 * Función debounce para evitar muchas llamadas consecutivas
 */
function debounce(func, wait) {
    let timeout;
    return function() {
        const context = this, args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            func.apply(context, args);
        }, wait);
    };
}

/**
 * Detecta la orientación del dispositivo y aplica cambios
 */
window.addEventListener('orientationchange', function() {
    // Aplicar cambios con pequeña demora para asegurar que la orientación ha cambiado
    setTimeout(function() {
        applyResponsiveChanges();
    }, 100);
});

/**
 * Prueba si estamos en un dispositivo móvil
 */
function isMobileDevice() {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

/**
 * Obtiene información completa del dispositivo
 */
function getDeviceInfo() {
    return {
        width: window.innerWidth,
        height: window.innerHeight,
        pixelRatio: window.devicePixelRatio || 1,
        userAgent: navigator.userAgent,
        isMobile: isMobileDevice(),
        orientation: window.innerHeight > window.innerWidth ? 'portrait' : 'landscape',
        type: getDeviceType(window.innerWidth)
    };
}

// Exponer funciones para uso global
window.responsiveHelper = {
    applyResponsiveChanges,
    getDeviceInfo,
    isMobileDevice
};