<?php
include("blog_db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $clave = trim($_POST['clave']);

    // Usar consulta preparada para seguridad
    $consulta = "SELECT * FROM admin WHERE nombre = ?";
    $stmt = mysqli_prepare($conn, $consulta);
    mysqli_stmt_bind_param($stmt, "s", $usuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($fila = mysqli_fetch_assoc($resultado)) {
<<<<<<< HEAD
        if (password_verify($clave, $fila['clave'])) {
            echo "¡Bienvenido, $usuario!";
            
=======
        // Verificar contraseña (asegúrate de que esté hasheada en la BD)
        if ($clave == $fila['contraseña']) { // Comparación directa (no recomendado para producción)
            // Iniciar sesión
            session_start();
            $_SESSION['admin'] = true;
            $_SESSION['usuario'] = $fila['nombre'];
            $_SESSION['id_admin'] = $fila['id'];
            
            echo "¡Bienvenido, ".htmlspecialchars($usuario)."!";
            // Redirigir al panel de admin después de 2 segundos
            header("Refresh: 2; url=admin_panel.php");
>>>>>>> 5b24d4a2e028dabf24c58c19e97ddb6dd12b916d
        } else {
            echo " Contraseña incorrecta.";
        }
    } else {
        echo " Usuario no encontrado.";
    }
    
    mysqli_stmt_close($stmt);
} else {
    echo " Acceso no autorizado.";
}

mysqli_close($conn);
?>