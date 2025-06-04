<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Términos de Privacidad - DIGITALMIND</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="progress-bar">
        <div id="progress" class="progress"></div>
    </div>

    <main class="container">
        <article class="content-item color-noticia-4" style="margin-top: 100px;">
            <div class="content-text">
                <h1 class="title">Términos de Privacidad</h1>
                
                <section>
                    <h2 class="title">1. Información que Recopilamos</h2>
                    <p>En DIGITALMIND, valoramos y respetamos tu privacidad. Podemos recopilar:</p>
                    <ul>
                        <li>Información personal: Nombre, email, datos de contacto</li>
                        <li>Datos de uso: Cómo interactúas con nuestro sitio</li>
                        <li>Datos técnicos: Dirección IP, navegador, dispositivo</li>
                    </ul>
                </section>
                
                <section>
                    <h2 class="title">2. Uso de la Información</h2>
                    <p>Utilizamos la información para:</p>
                    <ul>
                        <li>Proveer y mejorar nuestros servicios</li>
                        <li>Personalizar tu experiencia</li>
                        <li>Responder a tus consultas</li>
                        <li>Analizar el uso del sitio</li>
                    </ul>
                </section>
                
                <section>
                    <h2 class="title">3. Compartir Información</h2>
                    <p>No vendemos tu información personal. Podemos compartirla con:</p>
                    <ul>
                        <li>Proveedores de servicios (bajo confidencialidad)</li>
                        <li>Cuando sea requerido por ley</li>
                        <li>En fusiones o adquisiciones</li>
                    </ul>
                </section>
                
                <section>
                    <h2 class="title">4. Cookies</h2>
                    <p>Usamos cookies para:</p>
                    <ul>
                        <li>Recordar preferencias</li>
                        <li>Analizar tráfico</li>
                        <li>Mejorar la experiencia</li>
                    </ul>
                    <p>Puedes gestionarlas en tu navegador.</p>
                </section>
                
                <section>
                    <h2 class="title">5. Seguridad</h2>
                    <p>Implementamos medidas de seguridad, pero ningún sistema es 100% seguro.</p>
                </section>
                
                <section>
                    <h2 class="title">6. Tus Derechos</h2>
                    <p>Tienes derecho a:</p>
                    <ul>
                        <li>Acceder a tus datos</li>
                        <li>Corregir información</li>
                        <li>Eliminar tus datos</li>
                        <li>Oponerte al tratamiento</li>
                    </ul>
                </section>
                
                <section>
                    <h2 class="title">7. Cambios</h2>
                    <p>Actualizaremos esta política cuando sea necesario.</p>
                </section>
                
                <section>
                    <h2 class="title">8. Contacto</h2>
                    <p>Para preguntas sobre privacidad: digitalmindsocials@gmail.com</p>
                </section>
                
                <p style="text-align: right; font-style: italic;">Última actualización: <?php echo date('d/m/Y'); ?></p>
                
                <a href="index.php" class="see-more" style="display: inline-block; margin-top: 30px;">Volver al Inicio</a>
            </div>
        </article>
    </main>

    <?php include 'footer.php'; ?>

    <script>
        // Barra de progreso
        window.onscroll = function() {
            var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            var scrolled = (winScroll / height) * 100;
            document.getElementById("progress").style.width = scrolled + "%";
        };
    </script>
</body>
</html>