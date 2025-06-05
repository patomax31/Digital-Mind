<?php
require 'blog_db.php';

header('Content-Type: application/json');

// Verifica si los datos llegaron
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'No se recibió JSON']);
    exit;
}

if (!isset($data['ids']) || !is_array($data['ids'])) {
    echo json_encode(['success' => false, 'message' => 'IDs no válidos', 'data' => $data]);
    exit;
}

$ids = array_map('intval', $data['ids']);
$id_list = implode(',', $ids);

// Verifica si hay IDs válidos
if (empty($id_list)) {
    echo json_encode(['success' => false, 'message' => 'Lista de IDs vacía']);
    exit;
}

$sql = "UPDATE publicaciones_2 SET estado = 'publicado' WHERE id IN ($id_list)";


if (mysqli_query($conn, $sql)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => mysqli_error($conn)]);
}


