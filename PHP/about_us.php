<?php

session_start();
include 'blog_db.php';

$pageTitle = "Sobre Nosotros | DigitalMind";
include 'header.php';
include 'dashboard.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros | DigitalMind</title>
    <link rel="stylesheet" href="../css/about_us_style.css">
</head>

<body>
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Sobre Nosotros</h1>
            <p>En DigitalMind, combinamos innovación y creatividad para ofrecer soluciones digitales que transforman negocios y mejoran vidas.</p>
        </div>
    </section>

    <!-- Nueva Sección Inspiracional -->
    <section class="inspiration-section">
        <div class="inspiration-bg"></div>
        <div class="inspiration-container">
            <div class="inspiration-quote fade-in">
                "Estudiar no es solo aprender hechos, es entrenar tu mente para ver el mundo con una nueva perspectiva. Cada esfuerzo que pongas hoy será una semilla que crecerá en éxito mañana."
            </div>
            <div class="inspiration-author fade-in">
            </div>
        </div>
    </section>

    <!--Explicación del ODS
    <section class="section">
        <div class="container">
            <div class="section-header fade-in">
                <h2>¿Qué es el Objetivo para el Desarrollo Sostenible (ODS 4)?</h2>

                <p>Busca garantizar una educación inclusiva, equitativa y de calidad para todos, y promover oportunidades de aprendizaje permanente a lo largo de la vida</p>
            </div>
            <div class="section-content fade-in">
                <p>Somos</p>

                <p>Nos enfocamos en crear contenido de alta calidad, fácil de entender y aplicable a la vida real. Creemos que la educación debe ser un derecho, no un privilegio, y trabajamos incansablemente para hacer de este ideal una realidad.</p>
            </div>
        </div>
-->
    <!-- Nuestro Equipo -->
    <section class="section" style="background-color: #f9f9f9;">
        <div class="container">
            <div class="section-header fade-in">
                <h2>Conoce Nuestro Equipo</h2>
                <p>Las mentes detras de la plataforma</p>
            </div>

            <div class="team-grid">
                <div class="team-card fade-in">
                    <div class="team-img">
                        <a href="https://github.com/Alitan510">
                            <img src="../images/profile_pics/alan.jpg" alt="Desarrollador">
                        </a>
                    </div>
                    <div class="team-info">
                        <h3>Alan Alcaraz</h3>
                        <p>Desarrollador Back-End</p>
                        <p>Encargado del desarrollo y mantenimiento de la base de datos</p>
                    </div>
                </div>

                <div class="team-card fade-in">
                    <div class="team-img">
                        <a href="https://github.com/xim8989">
                            <img src="../images/profile_pics/xime.jpg" alt="Desarrollador">
                        </a>
                    </div>
                    <div class="team-info">
                        <h3>Ximena Cuevas</h3>
                        <p>Directora de diseño</p>
                        <p>Encargado de crear e implementar diseños y estilos de la plataforma.</p>
                    </div>
                </div>


                <div class="team-card fade-in">
                    <div class="team-img">
                        <a href="https://github.com/angel2312T">
                            <img src="../images/profile_pics/friedman.png" alt="Desarrollador">
                        </a>
                    </div>
                    <div class="team-info">
                        <h3>Friedman Cortez</h3>
                        <p>Desarrollador Front-End</p>
                        <p>Encargado de implementar diseño y las interfaces de los usuarios.</p>
                    </div>
                </div>

                <div class="team-card fade-in">
                    <div class="team-img">
                        <a href="https://github.com/ZinedineHMC">
                            <img src="../images/profile_pics/zinedine.jpg" alt="Desarrollador">
                        </a>
                    </div>
                    <div class="team-info">
                        <h3>Zinedine Hiram</h3>
                        <p>Desarrollador Front-End</p>
                        <p>Encargado de implementar funcionalidades a la pagina.</p>
                    </div>
                </div>

                <div class="team-card fade-in">
                    <div class="team-img">
                        <a href="https://github.com/ErnHerCebr">
                            <img src="../images/profile_pics/ernesto.png" alt="Desarrollador">
                        </a>
                    </div>
                    <div class="team-info">
                        <h3>Ernesto Cebrera</h3>
                        <p>Desarrollador Back-End</p>
                        <p>Encargado de la seguridad.</p>
                    </div>
                </div>

                <div class="team-card fade-in">
                    <div class="team-img">
                        <a href="https://github.com/patomax31">
                            <img src="../images/profile_pics/carlos.jpg" alt="Desarrollador">
                        </a>
                    </div>
                    <div class="team-info">
                        <h3>Carlos Rosas</h3>
                        <p>desarrollador Full stack</p>
                        <p>Encargado de revisar, implementar y testear el codigo desarrollado.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>



    <!-- Nuestros Valores -->
    <section class="section">
        <div class="container">
            <div class="section-header fade-in">
                <h2>Nuestros Valores</h2>
                <p>Los principios que guían cada decisión que tomamos</p>
            </div>

            <div class="values-grid">
                <div class="value-card fade-in">
                    <div class="value-icon">💡</div>
                    <h3>Orientacion</h3>
                    <p>Nuestra prioridad es dejar un impacto en la gente que nos visita.</p>
                </div>

                <div class="value-card fade-in">
                    <div class="value-icon">🤝</div>
                    <h3>Integridad</h3>
                    <p>Actuamos con honestidad y transparencia en todas nuestras relaciones.</p>
                </div>

                <div class="value-card fade-in">
                    <div class="value-icon">❤️</div>
                    <h3>Compromiso</h3>
                    <p>Nos comprometemos a crear tecnología que mejore el aprendizaje de las personas.</p>
                </div>

                <div class="value-card fade-in">
                    <div class="value-icon">🌍</div>
                    <h3>Impacto Social</h3>
                    <p>Cada publicacion es un nuevo aprendizaje, nos aseguramos que este impacto perdure en las personas.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="fade-in">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">DigitalMind</div>
                <p>Comprometidos con la educacion</p>
                <p><a href="terminos-privacidad.php">Terminos de privacidad</a></p>
                <p>&copy; 2025 DigitalMind. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Script para animaciones -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Activar animación del hero
            setTimeout(() => {
                document.querySelector('.hero').classList.add('visible');
            }, 100);

            // Configurar observador de intersección para las animaciones
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            // Observar todos los elementos con clase fade-in
            document.querySelectorAll('.fade-in').forEach(element => {
                observer.observe(element);
            });

            // Font Awesome para íconos sociales (opcional)
            const faScript = document.createElement('script');
            faScript.src = 'https://kit.fontawesome.com/a076d05399.js';
            faScript.crossOrigin = 'anonymous';
            document.head.appendChild(faScript);
        });
    </script>

    
</body>

</html>