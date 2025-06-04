<?php
require 'conexion.php'; // Asegúrate de tener tu conexión

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['ids']) || !is_array($data['ids'])) {
    echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
    exit;
}

$ids = array_map('intval', $data['ids']);
$id_list = implode(',', $ids);

$sql = "UPDATE blogs SET estado = 'archivado' WHERE id IN ($id_list)";
if (mysqli_query($conexion, $sql)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => mysqli_error($conexion)]);
}
