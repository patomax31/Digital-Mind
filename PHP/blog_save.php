<?php
// Activar la visualización de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir el archivo de conexión a la base de datos
require 'db.php';

// Verificar si el formulario se envió con POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar datos de entrada
    $titular = isset($_POST['titular']) ? htmlspecialchars($_POST['titular']) : '';
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
    $descripcion_corta = isset($_POST['descripcion_corta']) ? htmlspecialchars($_POST['descripcion_corta']) : '';
    $contenido = isset($_POST['contenido']) ? htmlspecialchars($_POST['contenido']) : '';
    $referencia = isset($_POST['referencia']) ? htmlspecialchars($_POST['referencia']) : null;

    // Validar que los campos obligatorios no estén vacíos
    if (empty($titular) || empty($fecha) || empty($descripcion_corta) || empty($contenido)) {
        die("Error: Todos los campos obligatorios deben ser llenados.");
    }

    // Insertar la publicación en la base de datos
    try {
        $sql = "INSERT INTO publicaciones (fecha, titular, descripcion_corta, imagen_principal, contenido, referencia) 
                VALUES (:fecha, :titular, :descripcion_corta, :imagen_principal, :contenido, :referencia)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':fecha' => $fecha,
            ':titular' => $titular,
            ':descripcion_corta' => $descripcion_corta,
            ':contenido' => $contenido,
            ':referencia' => $referencia,
        ]);

        // Redirigir si todo salió bien
        header("Location: admin.php");
        exit;
    } catch (PDOException $e) {
        die("Error en la base de datos: " . $e->getMessage());
    }
} else {
    die("Error: El formulario no fue enviado correctamente.");
}
?>
