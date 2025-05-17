<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'blog_db.php';

// Verificar si hay un usuario logueado
$loggedIn = isset($_SESSION['user_id']);
$userName = $loggedIn ? $_SESSION['user_name'] : '';

// Consulta para obtener las publicaciones más recientes (limitado a 5)
$recientes = [];
$sqlRecientes = "SELECT id, titular, fecha, imagen FROM publicaciones_2 ORDER BY fecha_creacion DESC LIMIT 5";
$resultRecientes = $conn->query($sqlRecientes);
if ($resultRecientes->num_rows > 0) {
    while($row = $resultRecientes->fetch_assoc()) {
        $recientes[] = $row;
    }
}

// IMPORTANTE: Vamos a cerrar la conexión aquí ya que no necesitamos mantenerla abierta
// index.php creará su propia conexión cuando la necesite
if (isset($conn)) {
    $conn->close();
}
?>

<style>
    /* Botón de menú */
    .menu-toggle {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #333;
        display: flex;
        align-items: center;
    }

    /* Menú flotante */
    .sidebar {
        position: fixed;
        top: 80px; /* Ajustado para el nuevo header */
        left: -280px;
        width: 280px;
        height: calc(100vh - 80px);
        background-color: white;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        z-index: 999;
        overflow-y: auto;
    }

    .sidebar.active {
        left: 0;
    }

    .sidebar-section {
        padding: 20px;
        border-bottom: 1px solid #eee;
    }

    .sidebar-section h3 {
        font-size: 18px;
        color: #4a6fa5;
        margin-bottom: 15px;
        padding-bottom: 5px;
        border-bottom: 1px solid #eee;
    }

    /* Elementos del menú */
    .menu-item {
        display: flex;
        align-items: center;
        padding: 14px 16px;
        margin-bottom: 8px;
        border-radius: 6px;
        text-decoration: none;
        color: #333;
        font-size: 16px;
        font-weight: 500;
        transition: all 0.2s;
        background-color: #f8f9fa;
    }

    .menu-item:hover {
        background-color: rgba(74, 111, 165, 0.1);
        color: #4a6fa5;
    }

    .menu-item i {
        margin-right: 12px;
        font-size: 20px;
        width: 24px;
        text-align: center;
    }

    /* Overlay */
    .overlay {
        position: fixed;
        top: 80px; /* Ajustado para el nuevo header */
        left: 0;
        width: 100%;
        height: calc(100vh - 80px);
        background-color: rgba(0,0,0,0.5);
        z-index: 998;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s;
    }

    .overlay.active {
        opacity: 1;
        visibility: visible;
    }

    /* Lista de noticias */
    .recent-posts {
        list-style: none;
        padding: 0;
    }

    .post-item {
        display: flex;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #eee;
    }

    .post-item:last-child {
        border-bottom: none;
    }

    .post-thumbnail {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
        margin-right: 12px;
    }

    .post-details {
        flex-grow: 1;
    }

    .post-title {
        font-weight: 600;
        color: #333;
        text-decoration: none;
        display: block;
        margin-bottom: 5px;
        font-size: 15px;
    }

    .post-title:hover {
        color: #4a6fa5;
    }

    .post-date {
        font-size: 13px;
        color: #666;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="overlay" id="overlay"></div>

<div class="sidebar" id="sidebar">
    <div class="sidebar-section">
        <h3>Menú Principal</h3>
        <a href="index.php" class="menu-item">
            <i class="fas fa-home"></i> Inicio

        <a href="#" class="menu-item">
            <i class="fas fa-folder"></i> Categorías
        </a>
        <a href="about_us.php" class="menu-item">
            <i class="fas fa-info-circle"></i> Acerca de Nosotros
        </a>
        <a href="contact_page.php" class="menu-item">
            <i class="fas fa-envelope"></i> Página de Contacto
        </a>
    </div>

    <div class="sidebar-section">
        <h3>Cuenta</h3>
        <?php if ($loggedIn): ?>
        <a href="logout.php" class="menu-item">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </a>
        <?php else: ?>
        <a href="login.php" class="menu-item">
            <i class="fas fa-key"></i> Iniciar Sesión
        </a>
        <a href="register.php" class="menu-item">
            <i class="fas fa-user"></i> Registrarse
        </a>
        <?php endif; ?>
    </div>

    <div class="sidebar-section">
        <h3>Noticias Recientes</h3>
        <ul class="recent-posts">
            <?php foreach ($recientes as $post): ?>
            <li class="post-item">
                <img src="<?php echo !empty($post['imagen']) ? '../images/publicaciones/' . htmlspecialchars($post['imagen']) : '../images/escuela1.jpg'; ?>" alt="Miniatura" class="post-thumbnail">
                <div class="post-details">
                    <a href="../PHP/post_completo.php?id=<?php echo $post['id']; ?>" class="post-title"><?php echo htmlspecialchars($post['titular']); ?></a>
                    <div class="post-date"><?php echo date("d/m/Y", strtotime($post['fecha'])); ?></div>
                </div>
            </li>
            <?php endforeach; ?>
            <?php if (empty($recientes)): ?>
            <li class="post-item">No hay publicaciones recientes</li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<script>
// Esperamos a que se cargue el DOM
document.addEventListener('DOMContentLoaded', function() {
    // Buscamos el botón de menú que debemos añadir
    const menuToggle = document.getElementById('menuToggle');
    if (!menuToggle) {
        // Si no existe, lo creamos y lo añadimos al header
        const headerLeft = document.querySelector('.header-left');
        if (headerLeft) {
            const button = document.createElement('button');
            button.id = 'menuToggle';
            button.className = 'menu-toggle';
            button.innerHTML = '<i class="fas fa-bars" style="font-size: 24px;"></i>';

            // Insertamos el botón al inicio del div header-left
            headerLeft.insertBefore(button, headerLeft.firstChild);
        }
    }

    // Ahora configuramos el evento para el botón (sea existente o recién creado)
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    // Función para configurar el botón de menú
    function setupMenuButton() {
        const toggleBtn = document.getElementById('menuToggle');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });
        }
    }

    // Configurar el botón
    setupMenuButton();

    // Ocultar menú al hacer clic en el overlay
    overlay.addEventListener('click', function() {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
    });

    // Ocultar menú al hacer clic fuera de él
    document.addEventListener('click', function(e) {
        const menuToggle = document.getElementById('menuToggle');
        if (!sidebar.contains(e.target) && e.target !== menuToggle && !e.target.closest('#menuToggle')) {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        }
    });
});
</script>