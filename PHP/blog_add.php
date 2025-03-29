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