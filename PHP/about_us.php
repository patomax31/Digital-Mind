<?php 
$pageTitle = "Sobre Nosotros | DigitalMind";
include 'header.php'; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros | DigitalMind</title>
    <style>
        /* Fuentes y colores base */
        @font-face {
            font-family: 'Roboto';
            src: url('../Fuentes/Roboto-Regular.ttf');
        }
        
        @font-face {
            font-family: 'CreatoDisplay';
            src: url('../Fuentes/CreatoDisplay-MediumItalic.otf');
        }
        
        :root {
            --primary-color: #294c5b;
            --secondary-color: #6d9eab;
            --background-color: #e3f2f7;
            --text-color: #2c2828;
            --white: #ffffff;
        }
        f
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        /* Estilos de transición */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }
        
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Header */
        .hero {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--white);
            padding: 8rem 2rem 6rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero h1 {
            font-family: 'CreatoDisplay', serif;
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease-out 0.2s, transform 0.8s ease-out 0.2s;
        }
        
        .hero p {
            max-width: 700px;
            margin: 0 auto;
            font-size: 1.2rem;
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease-out 0.4s, transform 0.8s ease-out 0.4s;
        }
        
        .hero.visible h1,
        .hero.visible p {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Contenedor principal */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        /* Secciones */
        .section {
            padding: 5rem 0;
            border-bottom: 1px solid rgba(0,0,0,0.1);
        }
        
        .section:last-child {
            border-bottom: none;
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .section-header h2 {
            font-family: 'CreatoDisplay', serif;
            color: var(--primary-color);
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .section-header p {
            max-width: 700px;
            margin: 0 auto;
            color: #666;
        }
        
        /* Tarjetas de equipo */
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .team-card {
            background: var(--white);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .team-card:hover {
            transform: translateY(-10px);
        }
        
        .team-img {
            height: 300px;
            overflow: hidden;
        }
        
        .team-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .team-card:hover .team-img img {
            transform: scale(1.05);
        }
        
        .team-info {
            padding: 1.5rem;
            text-align: center;
        }
        
        .team-info h3 {
            font-family: 'CreatoDisplay', serif;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .team-info p {
            color: var(--secondary-color);
            font-style: italic;
            margin-bottom: 1rem;
        }
    
        
        /* Valores */
        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .value-card {
            text-align: center;
            padding: 2rem;
            background: var(--white);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        
        .value-card:hover {
            transform: translateY(-5px);
        }
        
        .value-icon {
            font-size: 3rem;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
        }
        
        .value-card h3 {
            font-family: 'CreatoDisplay', serif;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        /* Footer */
        footer {
            background: var(--primary-color);
            color: var(--white);
            padding: 3rem 0;
            text-align: center;
        }
        
        .footer-content {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .footer-logo {
            font-family: 'CreatoDisplay', serif;
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }
        
        .social-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin: 2rem 0;
        }
        
        .social-links a {
            color: var(--white);
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }
        
        .social-links a:hover {
            color: var(--secondary-color);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .timeline::before {
                left: 31px;
            }
            
            .timeline-item {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }
            
            .timeline-item:nth-child(even) {
                left: 0;
            }
        }
        .inspiration-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 6rem 2rem;
            text-align: center;
            color: var(--white);
            position: relative;
            overflow: hidden;
        }
        
        .inspiration-container {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }
        
        .inspiration-quote {
            font-size: 2rem;
            line-height: 1.4;
            margin-bottom: 2rem;
            font-family: 'CreatoDisplay', serif;
            font-style: italic;
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }
        
        .inspiration-quote.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        .inspiration-author {
            font-size: 1.2rem;
            opacity: 0;
            transition: opacity 1s ease-out 0.5s;
        }
        
        .inspiration-author.visible {
            opacity: 1;
        }
        
        .inspiration-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.1;
            background-image: url('../images/abstract-bg.png');
            background-size: cover;
            z-index: 1;
        }

    </style>
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
                        <img src="../imagenes/foto_perfil_1.jpg" alt="Desarrollador">
                        </a>             
                    </div>
                    <div class="team-info">
                        <h3>Alan Alcaraz</h3>
                        <p>Desarrollador Back-End</p>
                        <p>Visionario tecnológico con más de 15 años de experiencia en desarrollo de software.</p>
                    </div>
                </div>
                
                <div class="team-card fade-in">
                    <div class="team-img">
                    <a href="https://github.com/xim8989">    
                        <img src="../imagenes/foto_perfil_1.jpg" alt="Desarrollador">
                        </a>                  
                      </div>
                    <div class="team-info">
                        <h3>Ximena Cuevas</h3>
                        <p>Directora de diseño</p>
                        <p>Especialista en experiencia de usuario y diseño de interfaces intuitivas.</p>
                    </div>
                </div>
                

                <div class="team-card fade-in">
                    <div class="team-img">
                    <a href="https://github.com/angel2312T">    
                        <img src="../imagenes/foto_perfil_1.jpg" alt="Desarrollador">
                        </a>
                    </div>
                    <div class="team-info">
                        <h3>Friedman Cortez</h3>
                        <p>Desarrollador Front-End</p>
                        <p>Experto en arquitectura de software y soluciones escalables.</p>
                    </div>
                </div>
                
                <div class="team-card fade-in">
                    <div class="team-img">
                    <a href="https://github.com/ZinedineHMC">    
                        <img src="../imagenes/foto_perfil_1.jpg" alt="Desarrollador">
                        </a>
                    </div>
                    <div class="team-info">
                        <h3>Zinedine Hiram</h3>
                        <p>Desarrollador Front-End</p>
                        <p>Experto en arquitectura de software y soluciones escalables.</p>
                    </div>
                </div>

                <div class="team-card fade-in">
                    <div class="team-img">
                    <a href="https://github.com/ErnHerCebr">    
                        <img src="../imagenes/foto_perfil_1.jpg" alt="Desarrollador">
                        </a>                    
                    </div>
                    <div class="team-info">
                        <h3>Ernesto Cebrera</h3>
                        <p>Desarrollador Back-End</p>
                        <p>Experto en arquitectura de software y soluciones escalables.</p>
                    </div>
                </div>
                
                <div class="team-card fade-in">
                    <div class="team-img">
                    <a href="https://github.com/patomax31">    
                        <img src="../imagenes/foto_perfil_1.jpg" alt="Desarrollador">
                        </a>
                    </div>
                    <div class="team-info">
                        <h3>Carlos Rosas</h3>
                        <p>Lider de desarrollo</p>
                        <p>Encargado de revisar, implementar y testear el codigo desarrollado</p>
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
                    <p>Nuestra prioridad es dejar un impacto en la gente que nos visita</p>
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