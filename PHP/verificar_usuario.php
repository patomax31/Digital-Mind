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
<<<<<<< HEAD
            
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
} else {
    echo "Acceso no autorizado.";
=======
            // Aquí podrías redirigir al panel del admin:
            // header("Location: panel_admin.php");
        } else {
            echo "❌ Contraseña incorrecta.";
        }
    } else {
        echo "❌ Usuario no encontrado.";
    }
} else {
    echo "❌ Acceso no autorizado.";
>>>>>>> 9f2072bb0fdba43851127bc59d45a794163276ce
}
?>