<?php
include("blog_db.php");
session_start();

if (isset($user['nombre']) && $user['nombre'] === 'carlos') {
    $user['rol'] = 'admin';
}

// Determinar si es usuario o admin
if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $sql_user = "SELECT * FROM usuarios WHERE id = '$usuario_id'";
    $user_result = $conn->query($sql_user);
    $user = $user_result->fetch_assoc();
} elseif (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $sql_user = "SELECT * FROM admin WHERE id = '$admin_id'";
    $user_result = $conn->query($sql_user);
    $user = $user_result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="../css/perfil_style.css">
    <style>
        
    </style>
</head>
<body>

<header style="display:flex;align-items:center;justify-content:space-between;padding:18px 50px 10px 32px;background:#fff;">
    <!-- Logo a la izquierda -->
    <div style="display:flex;align-items:center;">
        <a href="index.php" style="color:#007bff;">
            <img src="..\images\Logo_Mk2.png" alt="Logo" >
        
    </div>
    <!-- Logout SVG a la derecha -->
    <a href="logout.php" title="Cerrar sesión" style="color:#007bff;display:flex;align-items:center;">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:32px;height:32px;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
        </svg>
    </a>
</header>

<div class="perfil-container">
    <!-- Sidebar izquierda -->
    <div class="sidebar">

        <?php
        
        $avatar = !empty($user['avatar']) ? "/digital-mind/" . htmlspecialchars($user['avatar']) : "/digital-mind/uploads/avatar/default_avatar.png";
        ?>
        <img src="<?php echo $avatar; ?>" alt="Foto de perfil" style="width:120px; height:120px; border-radius:50%;">


        <form action="upload.php" method="POST" enctype="multipart/form-data" style="display:flex;flex-direction:column;align-items:center;">
            <div style="display:flex;flex-direction:row;align-items:center;gap:12px;">
                <label for="avatar" style="cursor:pointer;display:flex;flex-direction:column;align-items:center;">
            <svg class="svg-btn-avatar" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
            </svg>

            <span style="font-size:0.95em;color:#007bff;">Cambiar Foto</span>
            <input type="file" id="avatar" name="avatar" accept="image/*" style="display:none;">
            </label>
            <button type="submit" style="background:none;border:none;padding:0;cursor:pointer;display:flex;flex-direction:column;align-items:center;">
            <svg class="svg-btn-avatar" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 19.5-15-15m0 0v11.25m0-11.25h11.25" />
            </svg>
            <span style="font-size:0.95em;color:#007bff;">Subir</span>
    </button>
    </div>
</form>
        <div class="sidebar-menu">
            <a href="#info">Información Personal</a>
            <?php if (isset($user['rol']) && strtolower($user['rol']) === 'admin'): ?>
                <a href="#articulos">Mis Artículos</a>
            <?php endif; ?>
            <a href="#comentarios">Comentarios</a>
        </div>
    </div>
    <!-- Contenido principal -->
    <div class="main-content">
        <!-- Información personal -->
        <div class="info-card" id="info">
            <h3>Información Personal</h3>
            <div class="info-row">
                <div class="info-item"><strong>Nombre completo:</strong><br>
                <?php echo $user ? htmlspecialchars($user['nombre']) : 'No disponible'; ?></div>
                <div class="info-item"><strong>Correo electrónico:</strong><br>
                <?php echo $user ? htmlspecialchars($user['email']) : 'No disponible'; ?></div>
                <div class="info-item"><strong>Rol:</strong><br>
                <?php echo $user ? ucfirst(htmlspecialchars($user['rol'] ?? 'usuario')) : 'No disponible'; ?></div>
                <div class="info-item"><strong>Fecha de registro:</strong><br>
                <?php echo $user ? htmlspecialchars($user['fecha_registro'] ?? '') : 'No disponible'; ?></div>
            </div>
        </div>
        <!-- Artículos solo para admin -->
        <?php if (isset($user['rol']) && strtolower($user['rol']) === 'admin'): ?>
        <div class="section-list" id="articulos">
            <h3>Mis Artículos</h3>
            <ul>
            <?php
            $sql_blogs = "SELECT * FROM publicaciones_2 WHERE usuario_id = '" . ($usuario_id ?? $admin_id) . "'";
            $blogs_result = $conn->query($sql_blogs);
            if ($blogs_result && $blogs_result->num_rows > 0) {
                while ($blog = $blogs_result->fetch_assoc()) {
                    echo "<li><strong>" . htmlspecialchars($blog['titular']) . "</strong> <br><small>" . htmlspecialchars($blog['fecha']) . "</small></li>";
                }
            } else {
                echo "<li>No tienes artículos publicados.</li>";
            }
            ?>
            </ul>
        </div>
        <?php endif; ?>
        <!-- Comentarios -->
        <div class="section-list" id="comentarios">
            <h3>Comentarios</h3>
            <ul>
            <?php
            if (isset($user['rol']) && strtolower($user['rol']) === 'admin') {
    // Lista de nombres de admin según tu tabla admin
    $nombres_admin = ["Admin Principal", "Administrador", "Admin","carlos"];
    $nombres_sql = implode("','", array_map([$conn, 'real_escape_string'], $nombres_admin));
    $sql_comments = "SELECT * FROM comentarios WHERE nombre = '" . $conn->real_escape_string($user['nombre']) . "'";
    $comments_result = $conn->query($sql_comments);
    if ($comments_result && $comments_result->num_rows > 0) {
        while ($comment = $comments_result->fetch_assoc()) {
            echo "<li>" . htmlspecialchars($comment['comentario']) . "<br><small>" . htmlspecialchars($comment['fecha']) . "</small></li>";
        }
    } else {
        echo "<li>No has escrito comentarios.</li>";
    }
}
        
            ?>
            </ul>
        </div>
    </div>
</div>

<?php
include 'footer.php'; ?>


</body>
</html>