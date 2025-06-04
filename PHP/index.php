<?php
session_start();
include 'blog_db.php';
$pageTitle = "DIGITALMIND - Educación y Calidad";
include 'header.php';
include 'dashboard.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>DIGITALMIND - Educación y Calidad</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/seccion ods.css">
</head>
<body>
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

    <style>
    /* Contenedor de artículos centrado */
    .articles-grid-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        gap: 40px;
        padding: 20px 0;
    }

    /* Botón scroll to top */
    .scroll-top-btn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        background: #007bff;
        border: none;
        border-radius: 50%;
        color: white;
        cursor: pointer;
        display: none;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(0,123,255,0.3);
        transition: all 0.3s ease;
        z-index: 1000;
    }

    .scroll-top-btn:hover {
        background: #0056b3;
        transform: translateY(-2px);
    }

    .scroll-top-btn.visible {
        display: flex;
    }

    .scroll-top-btn svg {
        width: 24px;
        height: 24px;
    }
    </style>

    <?php include 'seccion ods.php'; ?>
    <?php include 'footer.php'; ?>



    <button id="scrollBtn" aria-label="Volver arriba">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path fill-rule="evenodd" d="M11.47 2.47a.75.75 0 011.06 0l7.5 7.5a.75.75 0 11-1.06 1.06l-6.22-6.22V21a.75.75 0 01-1.5 0V4.81l-6.22 6.22a.75.75 0 11-1.06-1.06l7.5-7.5z" clip-rule="evenodd" />
        </svg>
    </button>

    <script src="../PHP/prueba.js" defer></script>
    <script src="./translate.js"></script>

    <script>
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