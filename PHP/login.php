<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
</head>
<body>
    <form action="index.php" method="post">
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <br><br>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>
            <br><br>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>
            <br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br><br>

            <label for="bday">Fecha de Nacimiento:</label>
            <input type="date" id="bday" name="bday" required>
            <br><br>

            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" required>
            <br><br>

            <button type="submit">Registrarse</button>
        </div>
    </form>
</body>
</html>


<?php
    
   
   $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "test";  // ⚠️ Asegúrate de usar el nombre correcto de tu base de datos
    $conexion = new mysqli($server, $user, $pass, $db);
    
    // Verificar conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    
    // Solo procesar si se envió el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener datos del formulario
        $nombre = $_POST['nombre'] ?? '';
        $apellido = $_POST['apellido'] ?? '';
        $contrasena = $_POST['contraseña'] ?? '';
        $email = $_POST['email'] ?? '';
        $bday = $_POST['bday'] ?? '';  // Fecha de nacimiento
        $cantidad = $_POST['cantidad'] ?? 0;
    
        // Encriptar la contraseña por seguridad
      // Verificar que la contraseña no esté vacía
      if (!empty($contrasena)) {
        $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);
    } else {
        echo "❌ La contraseña no puede estar vacía.";
        exit;
    }
    
        // Preparar la consulta SQL para evitar inyección SQL
        $sql = "INSERT INTO usuarios (nombre, apellido, contrasena, email, bday, cantidad) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        // Usar sentencia preparada
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sssssi", $nombre, $apellido, $hashed_password, $email, $bday, $cantidad);
    
        // Ejecutar la consulta y verificar
        if ($stmt->execute()) {
            echo "✅ Registro exitoso.";
        } else {
            echo "❌ Error al registrar: " . $stmt->error;
        }
    
        // Cerrar la sentencia
        $stmt->close();
    }
    
    // Cerrar conexión
    $conexion->close();

?>