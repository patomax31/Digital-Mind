<?php
include("blog_db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $clave = trim($_POST['clave']);

    $consulta = "SELECT * FROM admin WHERE usuario = '$usuario'";
    $resultado = mysqli_query($conex, $consulta);

    if ($fila = mysqli_fetch_assoc($resultado)) {
        if (password_verify($clave, $fila['clave'])) {
            echo "¡Bienvenido, $usuario!";
            
        } else {
<<<<<<< HEAD
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
} else {
    echo "Acceso no autorizado.";
=======
            echo " Contraseña incorrecta.";
        }
    } else {
        echo " Usuario no encontrado.";
    }
} else {
    echo " Acceso no autorizado.";
>>>>>>> 728f426 (Arreglos)
}
?>