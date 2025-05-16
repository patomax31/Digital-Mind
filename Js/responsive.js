```js
// header-fix.js - Script para corregir problemas del header en navegación

document.addEventListener("DOMContentLoaded", function() {
  // Referencias a elementos
  const slidingHeader = document.getElementById("slidingHeader");
  const mainContent = document.querySelector("main");
  const body = document.body;

  // Detectar si estamos en una página interna
  const isInternalPage = window.location.href.includes("post_completo.php");
  
  // Aplicar clase si estamos en página interna
  if (isInternalPage) {
    body.classList.add("internal-page");
  } else {
    body.classList.remove("internal-page");
  }
  
  // Crear el menú hamburguesa para móvil si no existe
  if (window.innerWidth <= 767 && !document.querySelector('.hamburger-menu')) {
    createMobileMenu();
  }
  
  // Función para crear el menú móvil
  function createMobileMenu() {
    // Crear botón hamburguesa
    const hamburgerMenu = document.createElement('div');
    hamburgerMenu.className = 'hamburger-menu';
    hamburgerMenu.innerHTML = `
  
    `;
    
    // Crear contenedor de navegación móvil
    const mobileNav = document.createElement('div');
    mobileNav.className = 'mobile-nav';
    
    // Clonar elementos de navegación
    const headerActionsLeft = document.querySelector('.header-actions-left');
    const headerRight = document.querySelector('.header-right');
    
    if (headerActionsLeft) {
      const clone = headerActionsLeft.cloneNode(true);
      mobileNav.appendChild(clone);
    }
    
    if (headerRight) {
      const rightElements = headerRight.querySelectorAll('.action-container');
      rightElements.forEach(item => {
        const clone = item.cloneNode(true);
        mobileNav.appendChild(clone);
      });
    }
    
    // Agregar búsqueda si existe
    const searchElement = document.querySelector('.pill-search');
    if (searchElement) {
      const searchClone = searchElement.cloneNode(true);
      mobileNav.appendChild(searchClone);
    }
    
    // Añadir al DOM
    if (slidingHeader) {
      slidingHeader.appendChild(hamburgerMenu);
      body.insertBefore(mobileNav, slidingHeader.nextSibling);
      
      // Evento de click para mostrar/ocultar menú
      hamburgerMenu.addEventListener('click', function() {
        mobileNav.classList.toggle('active');
        this.classList.toggle('active');
      });
    }
  }
  
  // Corregir altura del contenido principal
  function adjustContentPosition() {
    if (!isInternalPage && mainContent) {
      const headerHeight = slidingHeader ? slidingHeader.offsetHeight : 0;
      mainContent.style.paddingTop = headerHeight + "px";
    }
  }
  
  // Manejar transiciones suaves del header en scroll
  let lastScrollTop = 0;
  window.addEventListener("scroll", function() {
    if (!slidingHeader) return;
    
    let currentScroll = window.pageYOffset || document.documentElement.scrollTop;
    
    if (currentScroll > lastScrollTop && currentScroll > 100) {
      // Scroll hacia abajo - ocultar header
      slidingHeader.style.transform = "translateY(-100%)";
    } else {
      // Scroll hacia arriba - mostrar header
      slidingHeader.style.transform = "translateY(0)";
    }
    
    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
  }, { passive: true });
  
  // Corregir estructura en cambio de tamaño de ventana
  window.addEventListener("resize", function() {
    // Actualizar menú según tamaño de ventana
    if (window.innerWidth <= 767 && !document.querySelector('.hamburger-menu')) {
      createMobileMenu();
    }
    
    // Ajustar posición del contenido
    adjustContentPosition();
  });
  
  // Aplicar clases de animación cuando se carga la página
  slidingHeader?.classList.add("slide-in");
  
  // Envolver el contenido principal para evitar problemas de z-index
  if (mainContent) {
    const wrapper = document.createElement('div');
    wrapper.className = 'content-overlay';
    mainContent.parentNode.insertBefore(wrapper, mainContent);
    wrapper.appendChild(mainContent);
  }
  
  // Corregir carrusel si existe
  const carrusel = document.querySelector('div[style="margin-top: 40px;"]');
  if (carrusel) {
    carrusel.classList.add('carrusel-container');
    carrusel.style.marginTop = '';
  }
  
  // Inicializar ajustes
  adjustContentPosition();
});

// Arreglar problema de navegación entre páginas
window.addEventListener('beforeunload', function() {
  // Guardar la posición de scroll en sessionStorage
  sessionStorage.setItem('scrollPosition', window.pageYOffset);
});

// Restaurar posición al cargar página
window.addEventListener('load', function() {
  // Comprobar si venimos de otra página del sitio
  const referrer = document.referrer;
  if (referrer && referrer.includes(window.location.hostname)) {
    const savedPosition = sessionStorage.getItem('scrollPosition');
    if (savedPosition !== null) {
      // Dar tiempo a que se cargue la página antes de hacer scroll
      setTimeout(function() {
        window.scrollTo(0, parseInt(savedPosition));
      }, 100);
    }
  }
  
  // Limpiar el sessionStorage
  sessionStorage.removeItem('scrollPosition');
});
```