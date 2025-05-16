<?php

include 'blog_db.php';

$resultado = $conn->query("SELECT * FROM categoria");
while ($cat = $resultado->fetch_assoc()){
    echo '<a href="secciones.php?id_categoria=' . $cat['id'] . '">' . $cat['nombre'] . '</a><br>';

}

?>