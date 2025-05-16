<?php
include("blog_db.php"); // Conexión a la base de datos

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Validación básica
    if (!empty($email) && !empty($password)) {
        $query = "SELECT * FROM usuarios WHERE email = ? AND rol = 'admin' LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows == 1) {
            $usuario = $resultado->fetch_assoc();

            // Compara la contraseña (puede ser hash en un caso real)
            if ($usuario['password'] === $password) {
                session_start();
                $_SESSION['admin'] = $usuario['email'];
                header("Location: admin_dashboard.php");
                exit;
            } else {
                $mensaje = "Contraseña incorrecta.";
            }
        } else {
            $mensaje = "Usuario administrador no encontrado.";
        }
    } else {
        $mensaje = "Por favor completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
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
</head>
<body>
    <h2>Login de Administrador</h2>
    <form method="POST" action="">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Iniciar Sesión">
    </form>

    <p style="color:red;"><?php echo $mensaje; ?></p>
</body>
</html>