<?php
include("blog_db.php");
session_start();

$usuario_id = $_SESSION['usuario_id'];

if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] == 0) {
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $file_type = mime_content_type($_FILES["avatar"]["tmp_name"]);

    if (in_array($file_type, $allowed_types)) {
        // Carpeta relativa al proyecto
        $target_dir = "../uploads/avatar/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
        $filename = uniqid("avatar_") . "." . $ext;
        $target_file = $target_dir . $filename;

        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
            // Guarda la ruta relativa para mostrarla en el navegador
            $avatar_path = "uploads/avatar/" . $filename;
            $sql = "UPDATE usuarios SET avatar='$avatar_path' WHERE id='$usuario_id'";
            $conn->query($sql);
        }
    }
    header("Location: perfil.php");
    exit();
}
?>