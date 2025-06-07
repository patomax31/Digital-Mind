<?php
session_start();
include("blog_db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM comentarios WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: crud.php?section=comentarios&success=comentario_eliminado");
    } else {
        header("Location: crud.php?section=comentarios&error=eliminacion_fallida");
    }
    exit();
}

header("Location: crud.php?section=comentarios");
exit();
