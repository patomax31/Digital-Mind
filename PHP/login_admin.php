<?php
include("blog_db.php"); // Asegúrate de que este archivo cree $conn

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST["usuario"]);
    $password = trim($_POST["password"]);

    if (!empty($usuario) && !empty($password)) {
        $stmt = $conn->prepare("SELECT * FROM admins WHERE usuario = ? AND password = ?");
        $stmt->bind_param("ss", $usuario, $password);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows == 1) {
            // Inicio de sesión exitoso
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $mensaje = "Credenciales incorrectas.";
        }
    } else {
        $mensaje = "Completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<<<<<<< HEAD

      <link rel="stylesheet" href="../css/login_admin.css">

      <link rel="stylesheet" href="../css/login_admin.css">

      <link rel="stylesheet" href="../css/login_admin.css">

</head>
<body>
    <h2>Login del Administrador</h2>
    <form method="POST" action="">
        <label>Usuario:</label><br>
        <input type="text" name="usuario" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Ingresar">
    </form>

    <title>Login Admin</title>
=======
    <title>Login Administrador</title>
>>>>>>> 58f5051 (Cambios)
</head>
<body>
    <h2>Login del Administrador</h2>
    <form method="POST" action="">
        <label>Usuario:</label><br>
        <input type="text" name="usuario" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Ingresar">
    </form>
    <p style="color:red;"><?php echo $mensaje; ?></p>
</body>
</html>