<?php
session_start();
include 'blog_db.php';

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

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIGITALMIND</title>
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
        
        body {
            background-color: var(--light-bg);
        }
        
        .header {
            background-color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        
        .logo {
            display: flex;
            align-items: center;
            font-weight: bold;
            font-size: 20px;
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .logo img {
            height: 30px;
            margin-right: 10px;
        }
        
        .menu-toggle {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--primary-color);
        }
        
        .sidebar {
            width: 280px;
            background-color: var(--dark-bg);
            color: white;
            position: fixed;
            top: 0;
            left: -280px;
            height: 100vh;
            z-index: 1100;
            transition: all 0.3s ease;
            padding-top: 70px;
            overflow-y: auto;
        }
        
        .sidebar.active {
            left: 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.2);
        }
        
        .sidebar-menu {
            padding: 20px 0;
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
        
        .main-content {
            margin-top: 70px;
            padding: 20px;
            transition: margin-left 0.3s;
        }
        
        .main-content.shifted {
            margin-left: 280px;
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
        
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1050;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
        }
        
        .overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        @media (min-width: 992px) {
            .main-content {
                margin-left: 0;
            }
            
            .sidebar {
                left: 0;
            }
            
            .main-content.shifted {
                margin-left: 280px;
            }
            
            .menu-toggle {
                display: none;
            }
            
            .overlay {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="index.php" class="logo">
            <img src="../images/Logo_Mk2.png" alt="DIGITALMIND">
            DIGITALMIND
        </a>
        <button class="menu-toggle">☰</button>
    </div>
    
    <div class="overlay" id="overlay"></div>
    
    <div class="sidebar" id="sidebar">
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
    </div>
    
    <div class="main-content" id="mainContent">
        <?php if ($loggedIn): ?>
        <!-- Dashboard para usuarios logueados -->
        <div class="card">
            <div class="card-header">
                <h2>Publicaciones Recientes</h2>
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
        <?php else: ?>
        <!-- Contenido para usuarios no logueados -->
        <div class="card">
            <h2>Bienvenido a DIGITALMIND</h2>
            <p>Para acceder a todas las funcionalidades, inicia sesión o regístrate</p>
            <div style="display: flex; gap: 10px; margin-top: 15px;">
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
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.querySelector('.menu-toggle');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const overlay = document.getElementById('overlay');
            
            // Toggle sidebar on button click
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
                
                // Solo aplicar el desplazamiento en móviles
                if (window.innerWidth < 992) {
                    mainContent.classList.toggle('shifted');
                }
            });
            
            // Cerrar sidebar al hacer clic en el overlay
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                mainContent.classList.remove('shifted');
            });
            
            // Ajustar para pantallas grandes
            function handleResize() {
                if (window.innerWidth >= 992) {
                    sidebar.classList.add('active');
                    overlay.classList.remove('active');
                    mainContent.classList.add('shifted');
                } else {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    mainContent.classList.remove('shifted');
                }
            }
            
            // Ejecutar al cargar y al redimensionar
            window.addEventListener('resize', handleResize);
            handleResize();
        });
    </script>
</body>
</html>