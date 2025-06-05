<?php
require 'blog_db.php'; // Asegúrate de tener tu conexión

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['ids']) || !is_array($data['ids'])) {
    echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
    exit;
}

$ids = array_map('intval', $data['ids']);
$id_list = implode(',', $ids);

$sql = "UPDATE publicaciones_2 SET estado = 'archivado' WHERE id IN ($id_list)";
if (mysqli_query($conn, $sql)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => mysqli_error($conn)]);
}
