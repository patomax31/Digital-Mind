<!DOCTYPE html>
<<<<<<< HEAD
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Formulario de Registro</h2>
    <form action="main_page.html" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br>

        <label for="bday">Fecha de Nacimiento:</label>
        <input type="date" name="bday" required><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" required><br>

        <button type="submit">Registrarse</button>
    </form>
</body>
</html>

<?php
$servername = "127.0.0.1";
$username = "root";  // Ajusta según tu configuración
$password = "";      // Ajusta según tu configuración
$dbname = "test"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptar la contraseña
$bday = $_POST['bday'];
$cantidad = intval($_POST['cantidad']); 

// Insertar datos en la base de datos
$sql = "INSERT INTO usuarios (nombre, apellido, email, contraseña, bday, cantidad) 
        VALUES ('$nombre', '$apellido', '$email', '$password', '$bday', $cantidad)";

if ($conn->query($sql) === TRUE) {
    echo "Registro exitoso";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
=======
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--"! tab = coloca la estructura de HTML"-->
    <form action="" method="post"> <!-- Metodo de PHP para cnoseguir los datos del formulario, GET inseguro, POST seguro momentaneo-->
    <!--"El for es para los lectores de pagina y es mas facil mantenerlo ordeenado"-->
        <div>
            <label for="nombre">nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="nombre...">
        <br>

        <br>

            <label for="apellido">apellido:</label>
            <input type="text" id="apellido" name="apellido" placeholder="apellido...">

        <br>
        <br>
            <label for="contraseña">contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" placeholder="contraseña..." maxlength="12" required>
        <br>    
        <br>    
            <label for="email">email:</label>
            <input type="email" id="email" name="email@gmail.com" placeholder="email...">        
        <br>    
        <br>    
            <label for="bday">bday:</label>
            <input type="date" id="bday" name="bday" placeholder="email...">        
        
        <br>
        <br>
            <label for="cantidad">cantidad:</label>
            <input type="text" id="cantidad" name="cantidad" placeholder="cantidad..." maxlength="3" required>
        <br>    
        </div>

        <br>
        
        <div>
            <input type="submit" value=="Log in">
        </div>

    </form>
</body>
</html>
</body>
</html>

<?php
    // holi
    /*Variables, funcionan como en cualquier otro lenguaje la misma aritmetica, operadores logicos y funciones matematicas 
    */ 

    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "pagina_web";
    
    $conexion = new mysqli($server, $user, $pass, $db);
    
    if ($conexion->connect_error) {
        die("Conexion fallida" . $conexion->connect_error);
    } else {    
        echo "Conectado";
    }

    
    $name = $_POST["nombre"];
    $apellido = $_POST ["apellido"];
    $contrasena = $_POST["contraseña"];
    $email = $_POST["email"];
    $bday = $_POST["bday"];
    $cantidad = $_POST["cantidad"];
    
    $precio = "2.99";
    $for_sale = true;    
    $total = $precio * $cantidad; //Funcion matematica con variables de php
 
    echo "Hola {$name} {$apellido} <br>";    
    echo "Tu email es: {$email} <br>";
    echo "Tu contraseña es: {$contraseña} <br>";
    echo "Ordenaste {$cantidad} tacos";
    echo "Precio: \${$total} <br>";
    
    /*
    echo "hola  {$name}<br>";
    echo "tu correo electronico es {$email}<br>";
    echo "El objeto esta en venta: {$for_sale} <br>";


    echo "Ordenaste {$quantity} por {$total}";
  */  

?>
>>>>>>> 55f392ac52d2d9bfa02979ec1625ffd878ff50ab
