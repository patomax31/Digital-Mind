<?php
// Iniciar sesión si no está iniciada
if (!isset($_SESSION)) {
    session_start();
}

// Verificar si hay un mensaje de bienvenida para mostrar
$mostrar_mensaje_bienvenida = false;
$usuario_nombre = "";

if (isset($_SESSION['mostrar_bienvenida']) && $_SESSION['mostrar_bienvenida'] === true) {
    $mostrar_mensaje_bienvenida = true;
    $usuario_nombre = $_SESSION['usuario_nombre'] ?? 'Usuario';
    
    // Limpiar la variable de sesión después de obtenerla
    unset($_SESSION['mostrar_bienvenida']);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>DIGITALMIND - Educación y Calidad</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/seccion ods.css">
    
    <style>
    .welcome-bar {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px 20px;
        margin: 20px auto; /* Centrar y añadir margen vertical */
        max-width: 1200px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        animation: slideDown 0.5s ease-out;
        position: relative; /* Asegura que absolute del close-button funcione correctamente en móviles */
        z-index: 100; /* Asegura que esté por encima de otros elementos si es necesario */
    }

    .welcome-message {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.1em;
        font-weight: 500;
    }

    .welcome-icon {
        font-size: 1.3em;
    }

    .close-welcome-bar {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        transition: background-color 0.3s ease;
        flex-shrink: 0;
    }

    .close-welcome-bar:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideUp {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-20px);
        }
    }

    @media (max-width: 768px) {
        .welcome-bar {
            margin: 20px 10px;
            padding: 12px 15px;
            flex-direction: column;
            gap: 10px;
            text-align: center;
            position: relative; /* Importante para el posicionamiento absoluto del botón de cerrar */
        }

        .welcome-message {
            font-size: 1em;
        }

        .close-welcome-bar {
            align-self: flex-end; /* Alinea a la derecha si es columna */
            position: absolute; /* Posiciona la 'x' absolutamente dentro de la barra */
            right: 15px;
            top: 10px;
        }
    }
    </style>
</head>
<body>
    <?php include 'dashboard.php'; ?>
    <?php include 'header.php'; ?>

    <?php if ($mostrar_mensaje_bienvenida): ?>
    <div id="welcomeBar" class="welcome-bar">
        <div class="welcome-message">
            <span class="welcome-icon">👋</span>
            <span>¡Hola, <?= htmlspecialchars($usuario_nombre) ?>! Bienvenido de vuelta a Digital Mind</span>
        </div>
        <button class="close-welcome-bar" onclick="closeWelcomeBar()" aria-label="Cerrar mensaje">
            ×
        </button>
    </div>
    <?php endif; ?>

    <main>
        <div class="articles-grid-container">
            <?php include 'dinamic_carrusel.php'; ?>
            <?php include 'carrusel_noticias.php'; ?>
        </div>
        
        <button id="scrollToTopBtn" class="scroll-top-btn" aria-label="Volver arriba">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M11.47 2.47a.75.75 0 011.06 0l7.5 7.5a.75.75 0 11-1.06 1.06l-6.22-6.22V21a.75.75 0 01-1.5 0V4.81l-6.22 6.22a.75.75 0 11-1.06-1.06l7.5-7.5z" clip-rule="evenodd" />
            </svg>
        </button>
    </main>

    <?php include 'seccion ods.php'; ?>

    <footer>
        <div class="footer-content">
            <p>Derechos Reservados &reg; Digital-Mind &copy; </p>
        </div>
    </footer>

    <button id="scrollBtn" aria-label="Volver arriba">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path fill-rule="evenodd" d="M11.47 2.47a.75.75 0 011.06 0l7.5 7.5a.75.75 0 11-1.06 1.06l-6.22-6.22V21a.75.75 0 01-1.5 0V4.81l-6.22 6.22a.75.75 0 11-1.06-1.06l7.5-7.5z" clip-rule="evenodd" />
        </svg>
    </button>

    <script src="../PHP/prueba.js" defer></script>
    <script src="./translate.js"></script>

    <script>
    // JavaScript para la barra de bienvenida
    function closeWelcomeBar() {
        const welcomeBar = document.getElementById('welcomeBar');
        if (welcomeBar) {
            welcomeBar.style.animation = 'slideUp 0.3s ease-out';
            setTimeout(() => {
                welcomeBar.style.display = 'none';
                // Opcional: ajustar el margen del main si esto causa un 'salto'
                // document.querySelector('main').style.marginTop = '0';
            }, 300);
        }
    }

    // Auto-cerrar la barra después de 5 segundos (opcional)
    // setTimeout(() => {
    //     closeWelcomeBar();
    // }, 5000);

    // Botón de scroll hacia arriba
    // Si tienes 'scrollToTopBtn' en el HTML y 'scrollBtn' en el JS, elige uno y sé consistente.
    // He dejado 'scrollBtn' aquí ya que es el que estaba en tu JS previamente.
    const scrollBtn = document.getElementById('scrollBtn');
    
    if (scrollBtn) {
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollBtn.classList.add('visible');
            } else {
                scrollBtn.classList.remove('visible');
            }
        });
        
        scrollBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    </script>
</body>
</html>