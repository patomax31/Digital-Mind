<?php

session_start();
include 'blog_db.php';

// Procesamiento del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_datos = "blog_db";

    $conn = new mysqli($host, $usuario, $contrasena, $base_datos);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $email = $_POST['email'] ?? '';
    $mensaje = $_POST['mensaje'] ?? '';

    if (
        !empty(trim($nombre)) &&
        !empty(trim($apellido)) &&
        !empty(trim($email)) &&
        !empty(trim($mensaje)) &&
        filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {
        $stmt = $conn->prepare("INSERT INTO contacto (nombre, apellido, email, mensaje) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $apellido, $email, $mensaje);

        if ($stmt->execute()) {
            echo "<script>alert('Mensaje enviado correctamente.');</script>";
        } else {
            echo "<script>alert('Error al enviar el mensaje: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Por favor, completa todos los campos correctamente.');</script>";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* --- Estilos generales --- */
        * { box-sizing: border-box; }
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            background: linear-gradient(to bottom, #c9e6f3, #e3f2f7);
            padding: 0;
        }

        header {
            text-align: center;
            padding: 100px 30px 20px;
            background-color: rgb(159, 182, 184);
        }

        header h1 {
            font-size: 58px;
            color: #ffffff;
            /* text-decoration: underline; */
        }   

        .contact-title {
            font-size: 48px;
            color: #003B6F;
            margin-bottom: 20px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .contact-info-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-box-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .info-box {
            background-color: #5E8092;
            color: white;
            padding: 15px 25px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 16px;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            text-decoration: none;
        }

        .info-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .info-box i {
            font-size: 20px;
        }

        .contact-info-container .img {
            max-width: 250px;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .contact-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            padding: 40px 20px;
            align-items: flex-start;
        }

        .glass-form {
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 30px;
            max-width: 500px;
            width: 100%;
        }

        .glass-form h2 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 24px;
            color: #003b6f;
        }

        .glass-form .form-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .glass-form input,
        .glass-form textarea {
            width: 100%;
            padding: 10px 15px;
            border-radius: 10px;
            border: none;
            margin-top: 15px;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.6);
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.05);
        }

        .glass-form .form-group input {
            width: calc(50% - 5px);
        }

        .glass-form button {
            margin-top: 20px;
            padding: 15px 30px;
            background: linear-gradient(45deg, #2563eb, #0d9488);
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            letter-spacing: 0.5px;
        }

        .glass-form button:hover {
            background: linear-gradient(45deg, #1d4ed8, #0f766e);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        .glass-form button:active {
            transform: translateY(0);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .map-placeholder {
            width: 100%;
            max-width: 600px;
            height: 400px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .faq-section {
            padding: 40px 20px;
            /*background-color: #f0f8ff;
            margin: 20px auto;
            max-width: 1000px;
            /*border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);*/
        }

        .faq-section h2 {
            text-align: center;
            color: #003b6f;
            margin-bottom: 30px;
            font-size: 32px;
        }

        .faq-item {
            margin-bottom: 15px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            padding: 15px 20px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .faq-question {
            font-weight: bold;
            color: #333;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 18px;
        }

        .faq-question i {
            margin-left: 10px;
            transition: transform 0.3s ease;
        }

        .faq-question.active i {
            transform: rotate(180deg);
        }

        .faq-answer {
            display: none;
            padding-top: 10px;
            color: #555;
            line-height: 1.6;
            border-top: 1px solid rgba(0, 0, 0, 0.08);
            margin-top: 10px;
            padding-top: 10px;
        }

        @media (max-width: 768px) {
            .form-group input {
                width: 100%;
            }
            .contact-section {
                flex-direction: column;
                align-items: center;
            }
            .map-placeholder {
                width: 100%;
                max-width: 500px;
            }
            .contact-info-container {
                margin-top: 20px;
            }
            .contact-info-container .img {
                max-width: 180px;
            }
        }
        /* ... existing code ... */

        /* Estilos para el botón de enviar */
        .submit-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 30px;
        background: linear-gradient(135deg, #00d2ff 0%, #3a7bd5 100%);
        color: #ffffff;
        border: none;
        border-radius: 25px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 210, 255, 0.2);
        position: relative;
        overflow: hidden;
        }

        .submit-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 210, 255, 0.3);
        }

        .submit-button:active {
        transform: translateY(1px);
        }

        .submit-button .arrow-icon {
        margin-left: 10px;
        font-size: 18px;
        transition: transform 0.3s ease;
        }

        .submit-button:hover .arrow-icon {
        transform: translateX(5px);
        }

        .submit-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            90deg,
            transparent,
            rgba(255, 255, 255, 0.2),
            transparent
        );
        transition: 0.5s;
        }

        .submit-button:hover::before {
        left: 100%;
        }

        /* Estilo para el botón deshabilitado */
        .submit-button:disabled {
        background: #cccccc;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
        }

        .submit-button:disabled:hover {
        transform: none;
        box-shadow: none;
        }

        .hero-header {
            position: relative;
            width: 100%;
            min-height: 55vh;
            background: url('../images/No te pierdas el experimento que demuestra que smartphones y videojuegos ayudan a los niños a mejorar su atención _ Alvaro Bilbao.jpg') center center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .hero-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(20, 40, 60, 0.45);
            backdrop-filter: blur(2px);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 90%;
            max-width: 800px;
            margin: 0 auto;
        }

        .hero-logo {
            position: absolute;
            left: 50%;
            bottom: 30px;
            transform: translateX(-50%);
            max-width: 18vw;
            min-width: 60px;
            width: 180px;
            margin-bottom: 0;
            filter: drop-shadow(0 4px 12px rgba(0,0,0,0.25));
            background: rgba(255,255,255,0.7);
            border-radius: 16px;
            padding: 8px 18px;
            z-index: 3;
        }

        .hero-title {
            color: #fff;
            font-size: 45px;
            font-weight: 700;
            text-shadow: 0 2px 12px rgba(0,0,0,0.35);
            margin: 0;
            line-height: 1.2;
            letter-spacing: 1px;
            /* background: rgba(0,0,0,0.25); */
            border-radius: 10px;
            padding: 12px 18px;
        }

        @media (max-width: 600px) {
            .hero-header { min-height: 35vh; }
            .hero-title { font-size: 1.1rem; padding: 8px 6px; }
            .hero-logo {
                left: 50%;
                bottom: 10px;
                width: 60px;
                padding: 4px 8px;
                transform: translateX(-50%);
            }
        }

    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'dashboard.php'; ?>

<header class="hero-header">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Contactanos</h1>
     
    </div>
    <img src="../images/Logo_MK2.png" alt="Logo DigitalMind" class="hero-logo">
</header>


  <div class="faq-section">
    <h2>Preguntas Frecuentes</h2>

    <div class="faq-item">
        <div class="faq-question">¿Qué es Digital Mind Social? <i class="fas fa-chevron-down"></i></div>
        <div class="faq-answer">
            Digital Mind Social es una plataforma digital comprometida con ofrecer recursos, herramientas y asesoría para mejorar la calidad educativa a través de soluciones inclusivas y tecnológicas.
        </div>
    </div>

    <div class="faq-item">
        <div class="faq-question">¿Qué servicios ofrece esta página web? <i class="fas fa-chevron-down"></i></div>
        <div class="faq-answer">
            Nuestra web brinda acceso a contenidos educativos, asesoramiento a docentes, materiales para el aula, herramientas digitales y un espacio de contacto para colaborar con instituciones educativas.
        </div>
    </div>

    <div class="faq-item">
        <div class="faq-question">¿A quién está dirigida esta plataforma? <i class="fas fa-chevron-down"></i></div>
        <div class="faq-answer">
            Está dirigida a docentes, estudiantes, instituciones educativas y familias interesadas en promover una educación más equitativa, moderna e inclusiva.
        </div>
    </div>

    <div class="faq-item">
        <div class="faq-question">¿Cómo contribuye esta página a una educación de calidad? <i class="fas fa-chevron-down"></i></div>
        <div class="faq-answer">
            Ofrecemos contenido actualizado, acceso gratuito a recursos educativos y acompañamiento digital que mejora la enseñanza y el aprendizaje con un enfoque centrado en el estudiante.
        </div>
    </div>

    <div class="faq-item">
        <div class="faq-question">¿Qué beneficios obtengo al contactar con Digital Mind Social? <i class="fas fa-chevron-down"></i></div>
        <div class="faq-answer">
            Al contactarnos, puedes recibir asesoramiento personalizado, participar en proyectos colaborativos, acceder a materiales exclusivos y contribuir a una red de transformación educativa.
        </div>
    </div>

    <div class="faq-item">
        <div class="faq-question">¿Tiene costo utilizar los recursos de la plataforma? <i class="fas fa-chevron-down"></i></div>
        <div class="faq-answer">
            No, todos nuestros recursos están disponibles de forma gratuita, porque creemos que la educación de calidad debe estar al alcance de todos.
        </div>
    </div>

</div>



    <div class="contact-section">
        <div class="contact-info-container">
            <div class="info-box-group">
                <a href="mailto:digitalmindsocial@gmail.com" class="info-box">
                    <i class="fas fa-envelope"></i> digitalmindsocial@gmail.com
                </a>
                <a href="tel:+3141278485392" class="info-box">
                    <i class="fas fa-phone"></i> +31 412 784 85392
                </a>
            </div>
            <img class="img" src="imagencontact.png" alt="Contact Image">
        </div>

        <form class="glass-form" method="POST" action="">
            <h2>Vamos a Enviar Un Mensaje Para Nosotros</h2>
            <div class="form-group">
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="text" name="apellido" placeholder="Apellido" required>
            </div>
            <input type="email" name="email" placeholder="Email" required>
            <textarea name="mensaje" rows="5" placeholder="Mensaje" required></textarea>
            <button class="submit-button">
                Enviar <span class="arrow-icon">→</span>
            </button>
        </form>

        <div class="map-placeholder">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d17421.28778389834!2d-104.39799602240048!3d19.121231992117586!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8424d13d19b417bd%3A0x39b8031b3aa4da05!2sUniversidad%20de%20Colima%20Campus%20El%20Naranjo!5e0!3m2!1ses-419!2smx!4v1747636186050!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        document.querySelectorAll('.faq-question').forEach(item => {
            item.addEventListener('click', event => {
                const answer = item.nextElementSibling;
                const icon = item.querySelector('i');

                document.querySelectorAll('.faq-answer').forEach(ans => {
                    if (ans !== answer && ans.style.display === 'block') {
                        ans.style.display = 'none';
                        ans.previousElementSibling.classList.remove('active');
                        ans.previousElementSibling.querySelector('i').style.transform = 'rotate(0deg)';
                    }
                });

                if (answer.style.display === 'block') {
                    answer.style.display = 'none';
                    item.classList.remove('active');
                    icon.style.transform = 'rotate(0deg)';
                } else {
                    answer.style.display = 'block';
                    item.classList.add('active');
                    icon.style.transform = 'rotate(180deg)';
                }
            });
        });
    </script>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('btn-translate');
    if (!btn) return;

    let translated = false;

    btn.addEventListener('click', async function() {
        if (translated) return; // Evita traducir dos veces

        // Selecciona todos los elementos de texto visibles (puedes ajustar el selector)
        const elements = Array.from(document.querySelectorAll('h1, h2, h3, h4, h5, h6, p, li, a, button, label, span, th, td'));

        // Filtra solo los elementos con texto visible
        const texts = elements.map(el => el.innerText.trim()).filter(t => t.length > 0);

        if (texts.length === 0) return;

        btn.disabled = true;
        btn.textContent = "Traduciendo...";

        // Llama a tu endpoint PHP
        const response = await fetch('translate.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'texts=' + encodeURIComponent(JSON.stringify(texts)) + '&target_lang=EN'
        });

        const data = await response.json();

        if (data.translatedTexts) {
            let i = 0;
            elements.forEach(el => {
                if (el.innerText.trim().length > 0) {
                    el.innerText = data.translatedTexts[i++] || el.innerText;
                }
            });
            btn.textContent = "Traducido";
            translated = true;
        } else {
            btn.textContent = "Error al traducir";
        }
        btn.disabled = false;
    });
});
</script>
</body>
</html>
