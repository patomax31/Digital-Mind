<?php
session_start();
require 'blog_db.php';

// 1. Verificar sesión de administrador
if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    $_SESSION['error'] = 'Debes iniciar sesión como administrador';
    header('Location: login_admin.php');
    exit();
}

// 2. Verificar token CSRF de forma segura
if (empty($_POST['csrf_token']) || empty($_SESSION['csrf_token'])) {
    $_SESSION['error'] = 'Token CSRF faltante';
    header("Location: blog_edit.php?id=".$_POST['id']);
    exit();
}

if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    $_SESSION['error'] = 'Token CSRF inválido';
    header("Location: blog_edit.php?id=".$_POST['id']);
    exit();
}

// 3. Validar ID de publicación
if (empty($_POST['id']) || !is_numeric($_POST['id'])) {
    $_SESSION['error'] = 'ID de publicación inválido';
    header('Location: admin_panel.php');
    exit();
}

$id = intval($_POST['id']);

// 4. Obtener publicación actual
$stmt = $conn->prepare("SELECT * FROM publicaciones_2 WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = 'Publicación no encontrada';
    header('Location: admin_panel.php');
    exit();
}

$current_post = $result->fetch_assoc();
$stmt->close();

// 5. Procesar datos del formulario
$titular = trim($_POST['titular']);
$descripcion_corta = trim($_POST['descripcion_corta']);
$contenido = trim($_POST['contenido']);
$fecha = trim($_POST['fecha']);
$referencia = isset($_POST['referencia']) ? trim($_POST['referencia']) : null;
$categoria = $_POST['categoria'] ?? '';
$autor = $_POST['autor'] ?? '';

// Validar campos requeridos
if (empty($titular) || empty($descripcion_corta) || empty($contenido) || empty($fecha)) {
    $_SESSION['error'] = 'Todos los campos requeridos deben estar completos';
    header("Location: blog_edit.php?id=$id");
    exit();
}

// Procesar imagen
$imagen = $current_post['imagen'];
$eliminar_imagen = isset($_POST['eliminar_imagen']) && $_POST['eliminar_imagen'] === 'on';

if ($eliminar_imagen && !empty($imagen)) {
    // Eliminar archivo de imagen
    $image_path = "../images/publicaciones/$imagen";
    if (file_exists($image_path)) {
        unlink($image_path);
    }
    $imagen = '';
}

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    // Eliminar imagen anterior si existe
    if (!empty($current_post['imagen'])) {
        $old_image_path = "../images/publicaciones/{$current_post['imagen']}";
        if (file_exists($old_image_path)) {
            unlink($old_image_path);
        }
    }

    // Procesar nueva imagen
    $upload_dir = "../images/publicaciones/";
    $file_extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
    $file_name = uniqid('post_') . '.' . strtolower($file_extension);
    $upload_path = $upload_dir . $file_name;

    // Validar tipo de archivo
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($_FILES['imagen']['type'], $allowed_types)) {
        $_SESSION['error'] = 'Solo se permiten imágenes JPEG, PNG, GIF o WebP';
        header("Location: blog_edit.php?id=$id");
        exit();
    }

    // Mover archivo subido
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $upload_path)) {
        $imagen = $file_name;
    } else {
        $_SESSION['error'] = 'Error al subir la imagen';
        header("Location: blog_edit.php?id=$id");
        exit();
    }
}

// 6. Actualizar la publicación en la base de datos
try {
    $stmt = $conn->prepare("UPDATE publicaciones_2 SET 
                          titular = ?,
                          descripcion_corta = ?,
                          contenido = ?,
                          fecha = ?,
                          referencia = ?,
                          imagen = ?
                          WHERE id = ?");

    $stmt->bind_param("ssssssi", 
        $titular,
        $descripcion_corta,
        $contenido,
        $fecha,
        $referencia,
        $imagen,
        $categoria,
        $autor,
        $id

    );

    if ($stmt->execute()) {
        // Regenerar el token CSRF para el próximo formulario
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        
        $_SESSION['success'] = 'Publicación actualizada correctamente';
        header("Location: admin_panel.php");
        exit();
    } else {
        throw new Exception("Error al actualizar la publicación: " . $stmt->error);
    }
} catch (Exception $e) {
    // Registrar error y redirigir
    error_log($e->getMessage());
    $_SESSION['error'] = 'Error al actualizar la publicación: ' . $e->getMessage();
    header("Location: blog_edit.php?id=$id");
    exit();
} finally {
    if (isset($stmt)) {
        $stmt->close();
    }
    $conn->close();
}
?>