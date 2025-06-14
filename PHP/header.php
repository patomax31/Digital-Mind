<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<!-- ...resto del código... -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($pageTitle) ? $pageTitle : 'DIGITALMIND - Educación y Calidad'; ?></title>
  <link rel="stylesheet" href="../css/search.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            <a href="categorias.php">Categoría</a>
          
            
          </div>
        <div class="action-container">
            
            <svg class="create-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
          </svg>

            <a href="about_us.php">Acerca de</a>
        </div>
      </div>
            <div class="action-container">
              <svg class="create-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
              <path d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
              <path d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
              </svg>

            <a href="contact_page.php">Pagina de contacto</a>
        </div>
      </div>
      <div class="action-container search-container">

<!-- Estilos -->
<link rel="stylesheet" href="../css/barra_busqueda.css">

<!-- Formulario de búsqueda visible y con estilo -->
<form id="search-form" action="buscar.php" method="GET" class="barra-busqueda">
  <input type="text" name="q" placeholder="buscar..." autocomplete="off" required />
  <button type="submit">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="white" width="20" height="20">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0a7 7 0 1 0-9.9-9.9 7 7 0 0 0 9.9 9.9z" />
    </svg>
  </button>
</form>
 

  <script>
  const searchIcon = document.getElementById('search-icon');
  const searchForm = document.getElementById('search-form');

  searchIcon.addEventListener('click', () => {
    if (searchForm.style.display === 'none' || searchForm.style.display === '') {
      searchForm.style.display = 'inline-block';
      searchForm.querySelector('input').focus();
    } else {
      searchForm.style.display = 'none';
    }
  });
</script>
</div>


          <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
      <div class="action-container">
        <svg class="Login-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
          <path fill-rule="evenodd" d="M3 3h18v2H3V3zm0 4h18v2H3V7zm0 4h18v2H3v-2zm0 4h18v2H3v-2zm0 4h18v2H3v-2z" clip-rule="evenodd" />
        </svg>
        <a href="crud.php">Panel Admin</a>
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

                  <span>Idioma</span>
              </button>
            </div>
      </div>

<div class="header-right">
  <?php if (isset($_SESSION['usuario']) || isset($_SESSION['admin'])): ?>
    <!-- Usuario logueado -->
    <div class="action-container user-logged">
      <a href="../PHP/perfil.php"> <!-- Added anchor tag here -->
        <img 
        src="<?php
          if (isset($_SESSION['usuario_avatar']) && !empty($_SESSION['usuario_avatar'])) {
              echo '/digital-mind/' . htmlspecialchars($_SESSION['usuario_avatar']);
          } else {
              echo '../images/profile_picture.png';
          }
        ?>" 
        alt="Foto de perfil" class="profile-pic">

        <span class="username">
          <?php
            if (isset($_SESSION['admin_nombre'])) {
                echo htmlspecialchars($_SESSION['admin_nombre']);
            } elseif (isset($_SESSION['usuario_nombre'])) {
                echo htmlspecialchars($_SESSION['usuario_nombre']);
            } elseif (isset($_SESSION['usuario']['nombre'])) {
                echo htmlspecialchars($_SESSION['usuario']['nombre']);
            } else {
                echo "Usuario";
            }
          ?>
        </span>


      </a> <!-- Closed anchor tag here -->
    </div>

    <!-- Mostrar botón solo si es ADMIN -->
    <?php if (isset($_SESSION['admin'])): ?>
      <div class="action-container">
<a href="crud.php">
  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24" style="vertical-align: middle; margin-right: 6px;">
    <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
  </svg>
  Panel Admin
</a>
      </div>
    <?php endif; ?>

    <!-- Botón de cerrar sesión -->
    <div class="action-container">
      <a href="../PHP/logout.php" class="logout-button">Cerrar sesión</a>
    </div>
  <?php else: ?>
    <!-- Usuario NO logueado -->
    <div class="action-container">
      <svg class="Login-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
      </svg>
      <a href="../PHP/register.php">Iniciar sesión</a>
    </div>
  <?php endif; ?>
</div>



</header>
  