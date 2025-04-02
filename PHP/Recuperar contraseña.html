<?php
include("con_db.php");

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $consulta = "SELECT * FROM usuarios WHERE reset_token = '$token'";
    $resultado = mysqli_query($conex, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $password = trim($_POST['password']);
            $password_hashed = password_hash($password, PASSWORD_BCRYPT);
            
            $update = "UPDATE usuarios SET contraseña = '$password_hashed', reset_token = NULL WHERE reset_token = '$token'";
            mysqli_query($conex, $update);
            
            echo "¡Contraseña restablecida con éxito!";
        }
    } else {
        echo "Token inválido.";
    }
} else {
    echo "Token no proporcionado.";
}
?>

<form method="POST">
    <label>Nueva Contraseña:</label>
    <input type="password" name="password" required>
    <input type="submit" value="Restablecer">
</form>
