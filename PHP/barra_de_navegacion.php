<?php include("blog_db.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar Noticia</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="PerfilCarda.css"> <!-- Estilo para el modal del perfil -->

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        nav {
            background-color: #001f7f;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .search-box {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            border-radius: 20px;
            padding: 5px 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            width: 200px; /* Ajusta el ancho total de la barra de búsqueda */
        }

        .search-box input[type="text"] {
            border: none;
            outline: none;
            width: 100%;
            padding: 5px;
            font-size: 14px;
            border-radius: 20px 0 0 20px;
        }

        .search-box button {
            background-color: #0077cc;
            border: none;
            color: white;
            padding: 5px 10px;
            border-radius: 0 20px 20px 0;
            cursor: pointer;
            font-size: 14px;
        }

        .search-box button:hover {
            background-color: #005fa3;
        }

        .list {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .list li {
            margin: 0 10px;
        }

        .list li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .list li a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">Vital News</div>
        <div class="search-box">
            <form action="buscar.php" method="GET" style="display: flex; align-items: center;">
                <input type="text" name="query" placeholder="Buscar...">
                <button type="submit">🔍</button>
            </form>
        </div>
        <ul class="list">
            <li><a href="index2.php">Inicio</a></li>
            <li><a href="#">Idioma</a></li>
            <li><a href="AdministrarNoticias.php">Administrar Noticias</a></li>
            <li><a href="AdminAgregarNoticia.php">Crear Noticia</a></li>
            <li><a href="crear_categoria.php">Crear Categoría</a></li>
            <li><a href="#" onclick="abrirPerfil()">Perfil</a></li>
            <li><a href="Nosotros.php">Nosotros</a></li>
        </ul>
    </nav>

<<<<<<< HEAD
    
=======
    <!-- Modal del perfil -->
>>>>>>> c15c370 (cambis realizados)
    <div id="perfilModal" class="profile-modal" style="display: none;">
        <button class="close-btn" onclick="cerrarPerfil()"><i class="fas fa-times"></i></button>
        <form id="perfilForm" action="ActualizarPerfil.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="profile-img-wrapper">
                <img class="profile-img" id="profileImg" src="default-profile.png" alt="Foto de perfil" />
                <label for="imgInput" class="edit-img-btn">
                    <i class="fas fa-camera"></i> Cambiar imagen
                </label>
                <input type="file" id="imgInput" name="profile_image" accept="image/*" style="display:none" onchange="previewImg(event)">
            </div>
            <div class="profile-details">
                <div class="profile-row">
                    <span class="profile-label">Nombre de usuario</span>
                    <input type="text" class="profile-value" id="username" name="username" value="nombrexd" required>
                </div>
                <div class="profile-row">
                    <span class="profile-label">Email</span>
                    <input type="email" class="profile-value" id="email" name="email" value="pepe@gmail.com" required>
                </div>
                <div class="profile-row">
                    <span class="profile-label">Nueva contraseña</span>
                    <div style="position:relative;">
                        <input type="password" class="profile-value" id="password" name="password" placeholder="Dejar en blanco para no cambiar" minlength="10" pattern="^\S{10,}$">
                        <i class="fas fa-eye toggle-password" onclick="togglePassword()" style="position:absolute; right:10px; top:50%; transform:translateY(-50%); cursor:pointer;"></i>
                    </div>
                    <small>Mínimo 10 caracteres, sin espacios</small>
                </div>
            </div>
            <button type="submit" class="close-main-btn">Guardar cambios</button>
        </form>
        <button class="close-main-btn" onclick="cerrarPerfil()">Cerrar</button>
    </div>

    <script>
        function abrirPerfil() {
            document.getElementById('perfilModal').style.display = 'block';
        }

        function cerrarPerfil() {
            document.getElementById('perfilModal').style.display = 'none';
        }

        function previewImg(event) {
            const reader = new FileReader();
            reader.onload = function () {
                document.getElementById('profileImg').src = reader.result;
            };
            if (event.target.files[0]) reader.readAsDataURL(event.target.files[0]);
        }

        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const icon = document.querySelector(".toggle-password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>

