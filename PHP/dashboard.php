<<<<<<< HEAD
<?php

include 'blog_db.php';
// Obtener estadísticas
$total_posts = $conn->query("SELECT COUNT(*) FROM publicaciones_2")->fetch_row()[0];
$latest_posts = $conn->query("SELECT * FROM publicaciones_2 ORDER BY fecha_creacion DESC LIMIT 5")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Administración de Blogs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .card {
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .sidebar {
            min-height: 100vh;
            background: #343a40;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.75);
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.1);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar bg-dark">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard.php">
                                <i class="bi bi-speedometer2 me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="blog
=======
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DIGITALMIND - Educación y Calidad</title>
  <link rel="stylesheet" href="../css/style.css">
  <script src="../PHP/prueba.js" defer></script>
  <script src="../PHP/carrusel.js" defer></script>
  <link rel="stylesheet" href="../css/carrusel.css">
  <link rel="stylesheet" href="../css/search.css">
  
  <!-- Estilos para el Dashboard lateral -->
  <style>
    /* Estilos del botón de apertura */
    #dashboardToggle {
      position: fixed;
      left: 20px;
      top: 100px;
      z-index: 1000;
      background-color: #5067ff;
      color: white;
      border: none;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      display: flex;
      justify-content: center;
      align-items: center;
      cursor: pointer;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease;
    }
    
    #dashboardToggle:hover {
      background-color: #3a4dc9;
      transform: scale(1.05);
    }
    
    /* Estilos del sidebar */
    .dashboard-sidebar {
      position: fixed;
      top: 0;
      left: -300px;
      width: 300px;
      height: 100vh;
      background-color: #fff;
      box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
      transition: left 0.3s ease;
      z-index: 1001;
      overflow-y: auto;
    }
    
    .dashboard-sidebar.active {
      left: 0;
    }
    
    .sidebar-header {
      padding: 20px;
      background-color: #5067ff;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .sidebar-header h2 {
      font-size: 1.5rem;
      font-weight: 600;
    }
    
    .close-btn {
      background: transparent;
      border: none;
      color: white;
      font-size: 1.5rem;
      cursor: pointer;
    }
    
    .sidebar-menu {
      padding: 20px 0;
    }
    
    .menu-section {
      margin-bottom: 20px;
    }
    
    .menu-section-title {
      padding: 10px 20px;
      font-size: 0.9rem;
      color: #666;
      text-transform: uppercase;
      letter-spacing: 1px;
    }
    
    .menu-items {
      list-style: none;
    }
    
    .menu-item {
      padding: 15px 20px;
      display: flex;
      align-items: center;
      cursor: pointer;
      transition: all 0.2s ease;
      color: #333;
      text-decoration: none;
    }
    
    .menu-item:hover {
      background-color: #f5f7ff;
      color: #5067ff;
    }
    
    .menu-item svg {
      margin-right: 15px;
      width: 20px;
      height: 20px;
    }
    
    .menu-item.active {
      background-color: #5067ff;
      color: white;
    }
    
    /* Sección de publicaciones recientes */
    .recent-posts {
      padding: 0 20px 20px;
    }
    
    .recent-post-item {
      padding: 12px 0;
      border-bottom: 1px solid #eee;
    }
    
    .recent-post-item:last-child {
      border-bottom: none;
    }
    
    .recent-post-title {
      font-size: 0.9rem;
      font-weight: 600;
      margin-bottom: 5px;
      color: #333;
    }
    
    .recent-post-date {
      font-size: 0.75rem;
      color: #888;
    }
    
    /* Overlay para cerrar al hacer clic fuera */
    .sidebar-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1000;
      display: none;
    }
    
    .sidebar-overlay.active {
      display: block;
    }
    
    /* Sección de usuario */
    .user-section {
      padding: 20px;
      display: flex;
      align-items: center;
      border-bottom: 1px solid #eee;
    }
    
    .user-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background-color: #eee;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-right: 15px;
    }
    
    .user-info {
      flex: 1;
    }
    
    .user-name {
      font-weight: 600;
      margin-bottom: 5px;
    }
    
    .user-status {
      font-size: 0.8rem;
      color: #888;
    }
    
    .login-buttons {
      display: flex;
      flex-direction: column;
      gap: 10px;
      padding: 20px;
    }
    
    .login-button, .register-button {
      padding: 10px;
      text-align: center;
      border-radius: 5px;
      cursor: pointer;
      font-weight: 600;
      transition: all 0.2s ease;
    }
    
    .login-button {
      background-color: #5067ff;
      color: white;
      border: none;
    }
    
    .login-button:hover {
      background-color: #3a4dc9;
    }
    
    .register-button {
      background-color: white;
      color: #5067ff;
      border: 1px solid #5067ff;
    }
    
    .register-button:hover {
      background-color: #f5f7ff;
    }
  </style>
</head>
<body>
  <header class="page-header-footer sliding-header" id="slidingHeader">
    <div class="page-container">
      <div class="header-left">
        <div class="logo">
          <a href="../PHP/main_page2.php">
            <img src="../images/Logo_Mk2.png" alt="Logo de DIGITALMIND">
          </a>
        </div>
        <div class="header-actions-left">
          <div class="action-container">
            <svg class="create-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
              <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
            </svg>
            <a href="../PHP/publicaciones.php" class="">Crear Blog</a>
          </div>
          <div class="action-container">
            <svg class="category-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 0 0-3 3v4.318a3 3 0 0 0 .879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 0 0 5.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 0 0-2.122-.879H5.25ZM6.375 7.5a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25Z" clip-rule="evenodd" />
            </svg>
            <a href="#" class="">Categoría</a>
          </div>
        </div>
      </div>
      <div class="header-right">
        <div class="action-container">
          <svg class="Login-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
          </svg>
          <a href="../PHP/register.php" class="">Iniciar sesión</a>
        </div>
        <div class="action-container">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
            <path d="M3 4a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4zm0 3a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7zm0 7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-6z" />
          </svg>
          <a href="../PHP/dashboard.php" class="">Dashboard</a>
        </div>
        <div class="sener">
          <div class="pill-search">
            <div class="search-icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z" clip-rule="evenodd" />
              </svg>
            </div>
            <input type="text" class="search-input" placeholder="Buscar...">
          </div>
        </div>
      </div>
    </div>
  </header>
  <div class="progress-bar">
    <div id="progress" class="progress"></div>
  </div>
  
  <!-- Botón para abrir el dashboard -->
  <button id="dashboardToggle" aria-label="Abrir dashboard">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <line x1="3" y1="12" x2="21" y2="12"></line>
      <line x1="3" y1="6" x2="21" y2="6"></line>
      <line x1="3" y1="18" x2="21" y2="18"></line>
    </svg>
  </button>
  
  <!-- Overlay para cerrar al hacer clic fuera -->
  <div class="sidebar-overlay"></div>
  
  <!-- Dashboard lateral -->
  <div class="dashboard-sidebar">
    <div class="sidebar-header">
      <h2>DIGITALMIND</h2>
      <button class="close-btn" aria-label="Cerrar dashboard">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </div>
    
    <!-- Sección de login/usuario (inicialmente para no logueados) -->
    <div class="login-buttons">
      <a href="login.php" class="login-button">Iniciar Sesión</a>
      <a href="register.php" class="register-button">Registrarse</a>
    </div>
    
    <!-- Menú principal -->
    <div class="sidebar-menu">
      <div class="menu-section">
        <div class="menu-section-title">Navegación</div>
        <ul class="menu-items">
          <a href="index.php" class="menu-item active">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
              <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            Inicio
          </a>
          <a href="dashboard.php" class="menu-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
              <line x1="3" y1="9" x2="21" y2="9"></line>
              <line x1="9" y1="21" x2="9" y2="9"></line>
            </svg>
            Dashboard
          </a>
          <a href="crear_blog.php" class="menu-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 5v14M5 12h14"></path>
            </svg>
            Crear Blog
          </a>
          <a href="contacto.php" class="menu-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
            </svg>
            Contacto
          </a>
        </ul>
      </div>
      
      <div class="menu-section">
        <div class="menu-section-title">Categorías</div>
        <ul class="menu-items">
          <a href="categoria.php?cat=educacion" class="menu-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
              <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
            </svg>
            Educación
          </a>
          <a href="categoria.php?cat=metodologias" class="menu-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
              <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
            </svg>
            Metodologías
          </a>
          <a href="categoria.php?cat=tendencias" class="menu-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"></circle>
              <line x1="2" y1="12" x2="22" y2="12"></line>
              <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
            </svg>
            Tendencias
          </a>
        </ul>
      </div>
    </div>
    
    <!-- Publicaciones recientes -->
    <div class="menu-section">
      <div class="menu-section-title">Publicaciones Recientes</div>
      <div class="recent-posts">
        <div class="recent-post-item">
          <div class="recent-post-title">EDUCACIÓN DE CALIDAD</div>
          <div class="recent-post-date">Publicado hace 10 horas</div>
        </div>
        <div class="recent-post-item">
          <div class="recent-post-title">Los mapas mentales en el aprendizaje</div>
          <div class="recent-post-date">Publicado hace 2 días</div>
        </div>
        <div class="recent-post-item">
          <div class="recent-post-title">Educacion en mexico</div>
          <div class="recent-post-date">Publicado hace 3 días</div>
        </div>
        <div class="recent-post-item">
          <div class="recent-post-title">Metodo Montessori</div>
          <div class="recent-post-date">Publicado hace 5 horas</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="container">
    <button id="scrollBtn">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.5" stroke="currentColor" class="size-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
      </svg>
    </button>
    <main>
      <div id="carrusel-container">
      </div>
      <div class="most-recent">Más Reciente</div>
      
      <!-- Contenido dinámico de PHP para las publicaciones -->
      
      <div class="content-item color-noticia-1">
        <div class="content-image">
          <img src="../images/Grafica Asistencia escolar.png" alt="Students">
        </div>
        <div class="content-text">
          <div class="title">EDUCACIÓN DE CALIDAD</div>
          <p>Capacidad de un sistema educativo para proporcionar a los estudiantes los conocimientos, habilidades y competencias necesarias para su desarrollo integral y bienestar futuro. Esto incluye el acceso a recursos educativos de calidad, la formación de docentes capacitados y la creación de un entorno de aprendizaje seguro y estimulante.</p>
          <p class="published">Publicado hace 10 horas</p>
          <a href="../PHP/blog_page_3.html" class="see-more">Ver más</a>
        </div>
      </div>

      <div class="content-item color-noticia-2">
        <div class="content-image">
          <img src="../images/escuela1.jpg" alt="Classroom">
        </div>
        <div class="content-text">
          <div class="title">Los mapas mentales en el aprendizaje</div>
          <p>Los mapas conceptuales son una herramienta de aprendizaje que ayuda a organizar ideas y conceptos para comprender y analizar temas. Son una estrategia de enseñanza-aprendizaje que facilita la comprensión de conceptos complejos y son una herramienta poderosa que todos deberiamos usar.</p>
          <p class="published">Publicado hace 2 días</p>
          <a href="blog_page_2-angel2312T.html" class="see-more">Ver más</a>
        </div>
      </div>

      <div class="content-item color-noticia-3">
        <div class="content-image">
          <img src="../images/escuela3.jpeg" alt="Library">
        </div>
        <div class="content-text">
          <div class="title">Educacion en mexico</div>
          <p>Situacion actual de la educacion en mexico y sus avances a lo larg odel siglo XX y el siglo XXI y lo que aun queda por hacer.</p>
          <p class="published">Publicado hace 3 días</p>
          <a href="../PHP/blog_page_3-angel2312T.html" class="see-more">Ver más</a>
        </div>
      </div>
      <div class="content-item color-noticia-4">
        <div class="content-image">
          <img src="../images/montessori_metodo.webp" alt="Método Montessori">
        </div>
        <div class="content-text">
          <div class="title">Metodo Montessori</div>
          <p>El método Montessori es un enfoque educativo centrado en el niño que se basa en la observación científica de su desarrollo natural. Este método fomenta la independencia, la libertad con límites y el respeto por el desarrollo físico, social y psicológico del niño.</p>
          <p class="published">Publicado hace 5 horas</p>
          <a href="Montessori_blog.html" class="see-more">Ver más</a>
        </div>
      </div>
    </main>
  </div>
  <footer>
    <div class="footer-content">
    <p>Derechos Reservados &reg; Digital-Mind &copy; </p>
    </div>
  </footer>
  
  <!-- Script para el dashboard lateral -->
  <script>
    // Funcionalidad para abrir y cerrar el dashboard
    document.addEventListener('DOMContentLoaded', function() {
      const dashboardToggle = document.getElementById('dashboardToggle');
      const dashboardSidebar = document.querySelector('.dashboard-sidebar');
      const sidebarOverlay = document.querySelector('.sidebar-overlay');
      const closeBtn = document.querySelector('.close-btn');
      
      // Función para abrir el dashboard
      function openDashboard() {
        dashboardSidebar.classList.add('active');
        sidebarOverlay.classList.add('active');
        document.body.style.overflow = 'hidden'; // Previene scroll en el fondo
      }
      
      // Función para cerrar el dashboard
      function closeDashboard() {
        dashboardSidebar.classList.remove('active');
        sidebarOverlay.classList.remove('active');
        document.body.style.overflow = ''; // Restaura el scroll
      }
      
      // Event listeners
      dashboardToggle.addEventListener('click', openDashboard);
      closeBtn.addEventListener('click', closeDashboard);
      sidebarOverlay.addEventListener('click', closeDashboard);
      
      // Cerrar al presionar la tecla Escape
      document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
          closeDashboard();
        }
      });
      
      // Actualizar la clase active para el elemento del menú actual
      const currentLocation = window.location.pathname;
      const menuItems = document.querySelectorAll('.menu-item');
      
      menuItems.forEach(item => {
        if (item.getAttribute('href') && currentLocation.includes(item.getAttribute('href'))) {
          menuItems.forEach(i => i.classList.remove('active'));
          item.classList.add('active');
        }
      });
    });
  </script>
</body>
</html> 
>>>>>>> 6158bf9f88fca00ee0676bab077c2dc69993ca7b
