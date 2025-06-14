<?php
session_start();

// Verificar si el usuario inició sesión y es admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: index.php');
    exit;
}

// Configuración de la base de datos
require 'blog_db.php';

// Configuración para subida de imágenes
$directorioImagenes = "../images/publicaciones/";
$extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
$maxTamano = 2 * 1024 * 1024; // 2MB

// Procesar la imagen
$nombreImagen = 'default-post.jpg'; // Valor por defecto

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['imagen']['tmp_name'];
    $fileName = $_FILES['imagen']['name'];
    $fileSize = $_FILES['imagen']['size'];
    $fileType = $_FILES['imagen']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Validaciones
    if (in_array($fileExtension, $extensionesPermitidas)) {
        if ($fileSize <= $maxTamano) {
            // Generar nombre único para la imagen
            $nombreImagen = uniqid('img_') . '.' . $fileExtension;
            $destino = $directorioImagenes . $nombreImagen;

            // Crear directorio si no existe
            if (!file_exists($directorioImagenes)) {
                mkdir($directorioImagenes, 0755, true);
            }

            // Mover el archivo
            if (!move_uploaded_file($fileTmpPath, $destino)) {
                die("Error al subir la imagen. Por favor, inténtalo de nuevo.");
            }
        } else {
            die("El tamaño de la imagen excede el límite permitido (2MB)");
        }
    } else {
        die("Formato de imagen no permitido. Solo se aceptan JPG, JPEG, PNG, GIF o WEBP");
    }
}

// Validar y sanitizar los datos del formulario
$titular = htmlspecialchars(trim($_POST['titular']));
$fecha = $_POST['fecha'];
$descripcion_corta = htmlspecialchars(trim($_POST['descripcion_corta']));
$categoria = $_POST['categoria_id'] ?? '';

// Sanitizar el contenido manteniendo etiquetas HTML básicas
$contenido = trim($_POST['contenido']);
$contenido = strip_tags($contenido, '<p><strong><em><u><a><ul><ol><li><h1><h2><h3><h4><h5><h6><br><hr><img><div><span>');

// Limpiar atributos potencialmente peligrosos
$contenido = preg_replace('/<(.*?)on[a-z]+="(.*?)"(.*?)>/i', '<$1$3>', $contenido);
$contenido = preg_replace('/<(.*?)javascript:(.*?)>(.*?)>/i', '<$1$3>', $contenido);

$referencia = filter_var(trim($_POST['referencia']), FILTER_SANITIZE_URL);

// Validaciones adicionales
if (empty($titular) || empty($fecha) || empty($descripcion_corta) || empty($contenido)) {
    die("Todos los campos obligatorios deben ser completados");
}

// Insertar en la base de datos
try {
    $stmt = $conn->prepare("INSERT INTO publicaciones_2 
        (titular, fecha, descripcion_corta, contenido, referencia, imagen, categoria_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("ssssssi", 
        $titular,
        $fecha,
        $descripcion_corta,
        $contenido, // Aquí guardamos el HTML formateado
        $referencia,
        $nombreImagen,
        $categoria_id);
    
    if ($stmt->execute()) {
        // Redirigir a la página de éxito o mostrar mensaje
        header("Location: blog_sucess.php?id=" . $stmt->insert_id);
        exit;
    } else {
        throw new Exception("Error al guardar la publicación: " . $stmt->error);
    }
} catch (Exception $e) {
    // Eliminar la imagen si hubo error después de subirla
    if ($nombreImagen !== 'default-post.jpg' && file_exists($directorioImagenes . $nombreImagen)) {
        unlink($directorioImagenes . $nombreImagen);
    }
    die($e->getMessage());
} finally {
    $stmt->close();
    $conn->close();
}

session_start();

// Verificar si el usuario inició sesión y es admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
    header('Location: index.php'); // o muestra mensaje de acceso denegado
    exit;
}

?>
