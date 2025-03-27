<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crear blog</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="includeHeader.js" defer></script>
    <script src="includeFooter.js" defer></script>

</head>
<body>
    <form action="blog_save.php" method="POST" enctype="multipart/form-data">
        <h2>Crear Nueva Publicación</h2>
        <label for="titular">Titular:</label>
        <input type="text" name="titular" id="titular" required>
        <br>
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha" required>
        <br>

        <label for="descripcion_corta">Descripción Corta:</label>
        <input type="text" name="descripcion_corta" id="descripcion_corta" required>
        <br>
    
        <label for="contenido">Contenido:</label>
        <textarea name="contenido" id="contenido" rows="10" required></textarea>
        <br>

        <label for="referencia">Referencia (opcional):</label>
        <input type="url" name="referencia" id="referencia">
        <br>

        <button type="submit">Publicar</button>
        <br>
    </form>
</body>
</html>

<?php
$servername = "localhost"; // Nombre del servidor
$username = "root"; // Nombre de usuario de la base de datos
$password = ""; // Contraseña de la base de datos
$dbname = "pagina_web"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";
?>

<?php
$sql = "SELECT id_noticia, fecha, titular, descripcion_corta, contenido, referencia FROM noticias";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Salida de datos de cada fila
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id_noticia"]. " - Fecha: " . $row["fecha"]. " - Titular: " . $row["titular"]. " - Descripción: " . $row["descriptcion_corta"]. " - Contenido: " . $row["contenido"]. " - Referencia: " . $row["referencia"]. "<br>";
    }
} else {
    echo "0 resultados";
}
$conn->close();
?>

<?php
$titular = "Nuevo titular";
$descripcion = "Descripción corta de la noticia";
$contenido = "Contenido completo de la noticia";
$referencia = "Referencia de la noticia";

$stmt = $conn->prepare("INSERT INTO noticias (fecha, titular, descriptcion_corta, contenido, referencia) VALUES (NOW(), ?, ?, ?, ?)");
$stmt->bind_param("ssss", $titular, $descripcion, $contenido, $referencia);

if ($stmt->execute()) {
    echo "Nueva noticia insertada correctamente";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>