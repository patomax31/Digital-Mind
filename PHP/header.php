<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($pageTitle) ? $pageTitle : 'DIGITALMIND - Educación y Calidad'; ?></title>
    <link rel="stylesheet" href="../css/search.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

  <!-- Incluir translate.js aquí para que esté disponible en todas las páginas que usan este header -->
  <script src="./translate.js" defer></script>

</head>
<body>
  <header class="page-header-footer sliding-header" id="slidingHeader">
    <div class="page-container">
      <div class="header-left">
        <div class="logo">
          <a href="index.php">
            <img src="../images/Logo_Mk2.png" alt="Logo de DIGITALMIND">
          </a>
        </div>
        <div class="header-actions-left">
       
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
          <div class="action-container">
            <svg class="create-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
            </svg>
            <a href="blog_add.php">Crear Blog</a>
          </div>


        <?php endif; ?>

          <div class="action-container dropdown">
            <svg class="category-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 0 0-3 3v4.318a3 3 0 0 0 .879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 0 0 5.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 0 0-2.122-.879H5.25ZM6.375 7.5a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25Z" clip-rule="evenodd" />
            </svg>
            <a href="#">Categoría</a>
            <div class="categoria-dropdown-content">
              <a href="categoria.php?categoria=educacion_p">Educacion Primaria</a>
              <a href="categoria.php?categoria=educacion_m">Educacion Media</a>
              <a href="categoria.php?categoria=educacion_ms">Educacion Media Superior</a>
              <a href="categoria.php?categoria=educacion_s">Educacion Superior</a>
            </div>
            
          </div>
        <div class="action-container">
            <svg class="create-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
              <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
            </svg>
            <a href="about_us.php">Acerca de</a>
        </div>
      </div>
              <div class="action-container">
            <svg class="create-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
              <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
            </svg>
            <a href="contact_page.php">Pagina de contacto</a>
        </div>
      </div>
          <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
      <div class="action-container">
        <svg class="Login-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
          <path fill-rule="evenodd" d="M3 3h18v2H3V3zm0 4h18v2H3V7zm0 4h18v2H3v-2zm0 4h18v2H3v-2zm0 4h18v2H3v-2z" clip-rule="evenodd" />
        </svg>
        <a href="admin_panel.php">Panel Admin</a>
      </div>
    <?php endif; ?>


      </div>
          <div class="traducir">
            <div class="action-container">
              <button id = "toggle-translate">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                width="32"
                height="32"
                viewBox="0 0 24 24"
                fill="none"
                stroke="#000000"
                stroke-width="1"
                stroke-linecap="round"
                stroke-linejoin="round"
                >
                <path d="M4 5h7" />
                <path d="M9 3v2c0 4.418 -2.239 8 -5 8" />
                <path d="M5 9c0 2.144 2.952 3.908 6.7 4" />
                <path d="M12 20l4 -9l4 9" />
                <path d="M19.1 18h-6.2" />
                </svg>

                  <span>Traducir</span>
              </button>
            </div>
      </div>

      <div class="header-right">
        <div class="action-container">
          <svg class="Login-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
          </svg>
          <a href="../PHP/register.php">Iniciar sesión</a>
        </div>
        <div class="search-container">
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

  