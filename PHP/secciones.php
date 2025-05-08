<?php

include 'blog_db.php';
$id_categoria = $_GET['id_categoria'];
$resultado = $conn->query("SELECT * FROM secciones WHERE id_categoria = $id_categoria");

while ($sec = $resultado->fetch_assoc()) {
    echo '<a href="publicaciones.php?id_seccion=' . $sec['id'] . '">' . $sec['nombre'] . '</a><br>';
}
?>