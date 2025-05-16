<?php
session_start();
include 'blog_db.php'; // Asegúrate de que este archivo existe y contiene la conexión a la BD

// Verificar si hay un usuario logueado
$loggedIn = isset($_SESSION['user_id']);
$userName = $loggedIn ? $_SESSION['user_name'] : '';

// Consulta para obtener categorías
$categorias = [];
$sqlCategorias = "SELECT DISTINCT referencia FROM publicaciones_2 ORDER BY referencia";
$resultCategorias = $conn->query($sqlCategorias);
if ($resultCategorias->num_rows > 0) {
    while($row = $resultCategorias->fetch_assoc()) {
        $categorias[] = $row['referencia'];
    }
}

// Consulta para obtener las publicaciones más recientes (limitado a 5)
$recientes = [];
$sqlRecientes = "SELECT id, titular, fecha, imagen FROM publicaciones_2 ORDER BY fecha_creacion DESC LIMIT 5";
$resultRecientes = $conn->query($sqlRecientes);
if ($resultRecientes->num_rows > 0) {
    while($row = $resultRecientes->fetch_assoc()) {
        $recientes[] = $row;
    }
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - DIGITALMIND</title>
    <style>
        :root {
            --primary-color: #4a6fa5;
            --secondary-color: #166088;
            --accent-color: #4fc3f7;
            --text-color: #333;
            --light-bg: #f5f7fa;
            --dark-bg: #263238;
            --success: #4caf50;
            --danger: #f44336;
            --warning: #ff9800;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .dashboard-container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }
        
        .sidebar {
            width: 250px;
            background-color: var(--dark-bg);
            color: white;
            padding: 20px 0;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease-in-out;
            position: fixed;
            height: 100vh;
            z-index: 1000;
            left: 0;
        }
        
        .sidebar.collapsed {
            left: -250px;
        }
        
        .sidebar-header {
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }
        
        .sidebar-header img {
            max-width: 150px;
            margin-bottom: 10px;
        }
        
        .sidebar-menu {
            padding: 20px 0;
            flex-grow: 1;
        }
        
        .menu-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.2s;
        }
        
        .menu-item:hover, .menu-item.active {
            background-color: rgba(255,255,255,0.1);
            color: white;
        }
        
        .menu-item i {
            margin-right: 10px;
            font-size: 18px;
        }
        
        .sidebar-footer {
            padding: 15px 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            font-size: 12px;
            color: rgba(255,255,255,0.6);
        }
        
        .main-content {
            flex-grow: 1;
            background-color: var(--light-bg);
            padding: 20px;
            overflow-y: auto;
            margin-left: 250px;
            transition: margin-left 0.3s ease-in-out;
        }
        
        .main-content.expanded {
            margin-left: 0;
        }
        
        .menu-toggle {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1100;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            transition: all 0.3s;
        }
        
        .menu-toggle:hover {
            background-color: var(--secondary-color);
        }
        
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
            padding-left: 50px; /* Espacio para el botón de menú */
        }
        
        .page-title {
            font-size: 24px;
            color: var(--text-color);
        }
        
        .user-menu {
            display: flex;
            align-items: center;
        }
        
        .user-info {
            margin-right: 15px;
            text-align: right;
        }
        
        .user-name {
            font-weight: 600;
            color: var(--text-color);
        }
        
        .user-role {
            font-size: 12px;
            color: #666;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .stat-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 24px;
        }
        
        .icon-blue {
            background-color: rgba(74, 111, 165, 0.1);
            color: var(--primary-color);
        }
        
        .icon-green {
            background-color: rgba(76, 175, 80, 0.1);
            color: var(--success);
        }
        
        .icon-orange {
            background-color: rgba(255, 152, 0, 0.1);
            color: var(--warning);
        }
        
        .stat-info h3 {
            font-size: 20px;
            margin-bottom: 5px;
        }
        
        .stat-info p {
            color: #666;
            font-size: 14px;
        }
        
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }
        
        .card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .card-header h2 {
            font-size: 18px;
            color: var(--text-color);
        }
        
        .card-actions a {
            padding: 6px 12px;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            transition: background-color 0.2s;
        }
        
        .card-actions a:hover {
            background-color: var(--secondary-color);
        }
        
        .recent-posts {
            list-style: none;
        }
        
        .post-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        
        .post-item:last-child {
            border-bottom: none;
        }
        
        .post-thumbnail {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 15px;
        }
        
        .post-details {
            flex-grow: 1;
        }
        
        .post-title {
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 5px;
            display: block;
            text-decoration: none;
        }
        
        .post-title:hover {
            color: var(--primary-color);
        }
        
        .post-date {
            font-size: 12px;
            color: #666;
        }
        
        .post-actions {
            display: flex;
            gap: 5px;
        }
        
        .action-btn {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            background-color: #f5f5f5;
            color: #666;
            text-decoration: none;
            transition: all 0.2s;
        }
        
        .action-btn:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        .login-required {
            text-align: center;
            padding: 40px 20px;
        }
        
        .login-required h2 {
            margin-bottom: 15px;
            color: var(--text-color);
        }
        
        .login-required p {
            margin-bottom: 20px;
            color: #666;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-block;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
        }
        
        .btn-outline {
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
        }
        
        .btn-outline:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        .categories-list {
            list-style: none;
        }
        
        .category-item {
            padding: 10px 15px;
            margin-bottom: 8px;
            background-color: #f5f5f5;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.2s;
        }
        
        .category-item:hover {
            background-color: #e9e9e9;
        }
        
        .category-name {
            font-weight: 500;
            color: var(--text-color);
        }
        
        .category-count {
            background-color: var(--primary-color);
            color: white;
            border-radius: 20px;
            padding: 3px 10px;
            font-size: 12px;
        }
        
        /* Responsive design */
        @media (max-width: 992px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
            
            .sidebar {
                left: -250px;
            }
            
            .sidebar.active {
                left: 0;
                box-shadow: 0 0 15px rgba(0,0,0,0.2);
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <button id="menuToggle" class="menu-toggle">☰</button>
        
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <img src="../images/Logo_Mk2.png" alt="Logo de DIGITALMIND">
                <h2>DIGITALMIND</h2>
            </div>
            <div class="sidebar-menu">
                <a href="index.php" class="menu-item active">
                    <i>🏠</i> Inicio
                </a>
                <a href="#" class="menu-item">
                    <i>📊</i> Dashboard
                </a>
                <a href="blog_add.php" class="menu-item">
                    <i>✏️</i> Crear Noticia
                </a>
                <a href="#" class="menu-item">
                    <i>🔍</i> Explorar
                </a>
                <?php if ($loggedIn): ?>
                <a href="logout.php" class="menu-item">
                    <i>🚪</i> Cerrar Sesión
                </a>
                <?php else: ?>
                <a href="login.php" class="menu-item">
                    <i>🔑</i> Iniciar Sesión
                </a>
                <a href="register.php" class="menu-item">
                    <i>👤</i> Registrarse
                </a>
                <?php endif; ?>
            </div>
            <div class="sidebar-footer">
                &copy; 2025 DIGITALMIND - Todos los derechos reservados
            </div>
        </div>
        
        <div class="main-content" id="mainContent">
            <div class="top-bar">
                <div class="page-title">Dashboard</div>
                <div class="user-menu">
                    <?php if ($loggedIn): ?>
                    <div class="user-info">
                        <div class="user-name"><?php echo htmlspecialchars($userName); ?></div>
                        <div class="user-role">Miembro</div>
                    </div>
                    <div class="user-avatar">
                        <?php echo strtoupper(substr($userName, 0, 1)); ?>
                    </div>
                    <?php else: ?>
                    <div class="user-info">
                        <div class="user-name">Invitado</div>
                    </div>
                    <div class="user-avatar">
                        G
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <?php if ($loggedIn): ?>
            <!-- Dashboard para usuarios logueados -->
            <div class="dashboard-stats">
                <div class="stat-card">
                    <div class="stat-icon icon-blue">📰</div>
                    <div class="stat-info">
                        <h3>5</h3>
                        <p>Noticias Publicadas</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-green">👥</div>
                    <div class="stat-info">
                        <h3>120</h3>
                        <p>Usuarios Registrados</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-orange">📊</div>
                    <div class="stat-info">
                        <h3>3</h3>
                        <p>Categorías</p>
                    </div>
                </div>
            </div>
            
            <div class="content-grid">
                <div>
                    <div class="card">
                        <div class="card-header">
                            <h2>Publicaciones Recientes</h2>
                            <div class="card-actions">
                                <a href="blog_add.php">Nueva Publicación</a>
                            </div>
                        </div>
                        <ul class="recent-posts">
                            <?php foreach ($recientes as $post): ?>
                            <li class="post-item">
                                <img src="<?php echo !empty($post['imagen']) ? '../images/publicaciones/' . htmlspecialchars($post['imagen']) : '../images/escuela1.jpg'; ?>" alt="Miniatura" class="post-thumbnail">
                                <div class="post-details">
                                    <a href="../PHP/post_completo.php?id=<?php echo $post['id']; ?>" class="post-title"><?php echo htmlspecialchars($post['titular']); ?></a>
                                    <div class="post-date"><?php echo date("d/m/Y", strtotime($post['fecha'])); ?></div>
                                </div>
                                <div class="post-actions">
                                    <a href="../PHP/post_completo.php?id=<?php echo $post['id']; ?>" class="action-btn" title="Ver">👁️</a>
                                    <a href="blog_edit.php?id=<?php echo $post['id']; ?>" class="action-btn" title="Editar">✏️</a>
                                </div>
                            </li>
                            <?php endforeach; ?>
                            <?php if (empty($recientes)): ?>
                            <li class="post-item">No hay publicaciones recientes</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                
                <div>
                    <div class="card">
                        <div class="card-header">
                            <h2>Categorías</h2>
                        </div>
                        <ul class="categories-list">
                            <?php foreach ($categorias as $categoria): ?>
                            <li class="category-item">
                                <span class="category-name"><?php echo htmlspecialchars($categoria); ?></span>
                                <span class="category-count">10</span>
                            </li>
                            <?php endforeach; ?>
                            <?php if (empty($categorias)): ?>
                            <li class="category-item">No hay categorías definidas</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <h2>Acciones Rápidas</h2>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                            <a href="blog_add.php" class="btn btn-primary" style="text-align: center;">
                                Crear Noticia
                            </a>
                            <a href="#" class="btn btn-outline" style="text-align: center;">
                                Ver Estadísticas
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <!-- Contenido para usuarios no logueados -->
            <div class="login-required">
                <h2>Bienvenido al Dashboard de DIGITALMIND</h2>
                <p>Para acceder a todas las funcionalidades, inicia sesión o regístrate</p>
                <div style="display: flex; justify-content: center; gap: 10px;">
                    <a href="login.php" class="btn btn-primary">Iniciar Sesión</a>
                    <a href="register.php" class="btn btn-outline">Registrarse</a>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h2>Noticias Destacadas</h2>
                </div>
                <ul class="recent-posts">
                    <?php foreach ($recientes as $post): ?>
                    <li class="post-item">
                        <img src="<?php echo !empty($post['imagen']) ? '../images/publicaciones/' . htmlspecialchars($post['imagen']) : '../images/escuela1.jpg'; ?>" alt="Miniatura" class="post-thumbnail">
                        <div class="post-details">
                            <a href="../PHP/post_completo.php?id=<?php echo $post['id']; ?>" class="post-title"><?php echo htmlspecialchars($post['titular']); ?></a>
                            <div class="post-date"><?php echo date("d/m/Y", strtotime($post['fecha'])); ?></div>
                        </div>
                        <div class="post-actions">
                            <a href="../PHP/post_completo.php?id=<?php echo $post['id']; ?>" class="action-btn" title="Ver">👁️</a>
                        </div>
                    </li>
                    <?php endforeach; ?>
                    <?php if (empty($recientes)): ?>
                    <li class="post-item">No hay publicaciones recientes</li>
                    <?php endif; ?>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            // Comprueba el tamaño de la pantalla al cargar
            checkScreenSize();
            
            // Comprueba el tamaño de la pantalla al redimensionar
            window.addEventListener('resize', checkScreenSize);
            
            // Toggle sidebar on button click
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                mainContent.classList.toggle('expanded');
            });
            
            // Función para comprobar el tamaño de la pantalla
            function checkScreenSize() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('active');
                    mainContent.classList.remove('expanded');
                } else {
                    sidebar.classList.add('active');
                    mainContent.classList.add('expanded');
                }
            }
        });
    </script>
</body>
</html>