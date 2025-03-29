<?php
include 'blog_db.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $titular = $_POST["titular"];
    $fecha = $_POST["fecha"];
    $descripcion_corta = $_POST["descripcion_corta"];
    $contenido = $_POST["contenido"];
    $referencia = isset($_POST["referencia"]) && !empty($_POST["referencia"]) ? $_POST["referencia"] : "";

    $stmt = $conn->prepare("INSERT INTO publicaciones (titular, fecha, descripcion_corta, contenido, referencia) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $titular, $fecha, $descripcion_corta, $contenido, $referencia);
    if ($stmt->execute()){
        echo "Publicacion guardada correctamente.";
    } else{
        echo "Error al guardar: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acceso no autorizado.";
}

?>
