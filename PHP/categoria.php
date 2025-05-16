<?php
include 'blog_db.php';

$categoria = isset($_GET['categoria']) ? $conn->real_escape_string($_GET['categoria']) : '';

if (empty($categoria)) {
    die("Categoría no especificada.");
}

$sql = "SELECT * FROM publicaciones_2 WHERE categoria = '$categoria' ORDER BY fecha DESC";
$resultado = $conn->query($sql);

include 'header.php';
?>

<div class="container">
    <h1>Publicaciones en "<?php echo htmlspecialchars($categoria); ?>"</h1>

    <?php if ($resultado->num_rows > 0): ?>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
            <div class="post">
                <h2><a href="post_completo.php?id=<?php echo $fila['id']; ?>">
                    <?php echo htmlspecialchars($fila['titular']); ?>
                </a></h2>
                <p><?php echo htmlspecialchars($fila['descripcion_corta']); ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay publicaciones en esta categoría.</p>
    <?php endif; ?>
</div>

<?php
include 'footer.php';
$conn->close();
?>
