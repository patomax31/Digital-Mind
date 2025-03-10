<!DOCTYPE html>
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
    <form action="index.php" method="post"> <!-- Metodo de PHP para cnoseguir los datos del formulario, GET inseguro, POST seguro momentaneo-->
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
    $db = "test";
    
    $conexion = new mysqli($server, $user, $pass, $db);
    
    if ($conexion->connect_error) {
        die("Conexion fallida" . $conexion->connect_error);
    } else {    
        echo "Conectado";
    }

    
    $name = $_POST["nombre"];
    $apellido = $_POST ["apellido"];
    $contraseña = $_POST["contraseña"];
    $email = $_POST["email"];
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