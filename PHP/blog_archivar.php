<?php
session_start();
include("blog_db.php");

// 1. Verificar sesión y permisos
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// 2. Procesar archivar/desarchivar
if (isset($_GET['id']) && isset($_GET['accion'])) {
    $id = intval($_GET['id']);
    $accion = $_GET['accion'];

    // Validar acción
    if ($accion === 'archivar') {
        $nuevo_estado = 'archivado';
        $mensaje = 'Post archivado correctamente.';
        $redireccion = 'crud.php?success=archivado';
    } elseif ($accion === 'desarchivar') {
        $nuevo_estado = 'publicado';
        $mensaje = 'Post desarchivado correctamente.';
        $redireccion = 'crud.php?section=archivados&success=desarchivado';
    } else {
        header("Location: crud.php?error=accion_invalida");
        exit();
    }

    // 3. Actualizar base de datos
    $query = "UPDATE publicaciones_2 SET estado = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $nuevo_estado, $id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['mensaje_archivo'] = $mensaje; // Guardar mensaje en sesión
        header("Location: $redireccion");
    } else {
        $_SESSION['mensaje_archivo'] = "Error al actualizar el estado.";
        header("Location: crud.php?error=bd");
    }
    exit();
}

// 4. Redirección si faltan parámetros
header("Location: crud.php");
?>
