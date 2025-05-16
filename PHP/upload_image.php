<?php
session_start();

header('Content-Type: application/json');

// Verificar autenticación y token CSRF
if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401);
    die(json_encode(['error' => 'No autorizado']));
}

if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    http_response_code(403);
    die(json_encode(['error' => 'Token CSRF inválido']));
}

// Configuración de directorio
$uploadDir = '../uploads/blog_content/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Validar archivo
if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    die(json_encode(['error' => 'Error al subir el archivo']));
}

// Validar tipo de archivo
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
$fileInfo = finfo_open(FILEINFO_MIME_TYPE);
$detectedType = finfo_file($fileInfo, $_FILES['file']['tmp_name']);
finfo_close($fileInfo);

if (!in_array($detectedType, $allowedTypes)) {
    http_response_code(400);
    die(json_encode(['error' => 'Tipo de archivo no permitido']));
}

// Validar tamaño (máximo 2MB)
if ($_FILES['file']['size'] > 2097152) {
    http_response_code(400);
    die(json_encode(['error' => 'El archivo es demasiado grande (máximo 2MB)']));
}

// Generar nombre único
$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
$filename = uniqid() . '.' . $extension;
$destination = $uploadDir . $filename;

// Mover archivo
if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {
    echo json_encode(['location' => '/uploads/blog_content/' . $filename]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Error al guardar el archivo']);
}
?>