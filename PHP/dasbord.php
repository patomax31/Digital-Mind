<?php

// Configuración de la base de datos
$servername = "127.0.0.1"; // O la dirección de tu servidor MySQL
$username = "tu_usuario"; // Tu nombre de usuario de MySQL
$password = "tu_contraseña"; // Tu contraseña de MySQL
$dbname = "poder_igualitario"; // El nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Función para obtener todas las publicaciones
function obtenerPublicaciones($conn) {
    $sql = "SELECT id_noticia, titular, fecha, descripcion_corta FROM publicaciones";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $publicaciones = array();
        while ($row = $result->fetch_assoc()) {
            $publicaciones[] = $row;
        }
        return $publicaciones;
    } else {
        return array();
    }
}

// Obtener todas las publicaciones
$publicaciones = obtenerPublicaciones($conn);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard de Publicaciones</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Dashboard de Publicaciones</h1>

    <h2>Lista de Publicaciones</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titular</th>
                <th>Fecha</th>
                <th>Descripción Corta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($publicaciones as $publicacion): ?>
                <tr>
                    <td><?php echo $publicacion['id_noticia']; ?></td>
                    <td><?php echo $publicacion['titular']; ?></td>
                    <td><?php echo $publicacion['fecha']; ?></td>
                    <td><?php echo $publicacion['descripcion_corta']; ?></td>
                    <td><a href="ver_publicacion.php?id=<?php echo $publicacion['id_noticia']; ?>">Ver</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php // Opcional: Formulario para agregar publicaciones ?>

</body>
</html>

<?php $conn->close(); ?>