<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "usuario", "contraseña", "nombre_de_base_de_datos");

// Verifica conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recoge el término de búsqueda
$searchTerm = $_GET['query'];

// Escapa caracteres especiales para evitar inyecciones SQL
$searchTerm = $conn->real_escape_string($searchTerm);

// Consulta a la base de datos (ejemplo: buscando en la tabla de publicaciones)
$sql = "SELECT * FROM publicaciones WHERE titulo LIKE '%$searchTerm%'";
$result = $conn->query($sql);

// Mostrar resultados
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<h2>" . htmlspecialchars($row["titulo"]) . "</h2>";
        echo "<p>" . htmlspecialchars($row["contenido"]) . "</p><hr>";
    }
} else {
    echo "No se encontraron resultados.";
}

$conn->close();
?>