<?php
session_start();
include("blog_db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: crud.php?section=comentarios");
    exit();
}

$id = intval($_GET['id']);
$mensaje = "";

// Procesar formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $comentario = trim($_POST['comentario'] ?? '');

    if ($nombre !== '' && $comentario !== '') {
        $sql = "UPDATE comentarios SET nombre = ?, comentario = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $nombre, $comentario, $id);
        if ($stmt->execute()) {
            header("Location: crud.php?section=comentarios&success=editado");
            exit();
        } else {
            $mensaje = "Error al actualizar el comentario.";
        }
        $stmt->close();
    } else {
        $mensaje = "Todos los campos son obligatorios.";
    }
}

// Obtener datos actuales del comentario
$sql = "SELECT nombre, comentario FROM comentarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nombre, $comentario);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Comentario</title>
    <style>
        body {
            background: #f4f8fb;
            font-family: 'Segoe UI', Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .edit-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 38px 32px 28px 32px;
            min-width: 350px;
            max-width: 400px;
        }
        .edit-container h2 {
            margin-top: 0;
            color: #222;
            text-align: center;
            margin-bottom: 18px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        label {
            display: block;
            color: #333;
            margin-bottom: 6px;
            font-weight: 500;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #cfd8dc;
            border-radius: 6px;
            font-size: 1em;
            background: #f9fbfc;
            transition: border 0.2s;
        }
        input[type="text"]:focus, textarea:focus {
            border-color: #007bff;
            outline: none;
        }
        textarea {
            min-height: 80px;
            resize: vertical;
        }
        .btn-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 18px;
        }
        button[type="submit"], .cancel-btn {
            padding: 8px 22px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.2s;
        }
        button[type="submit"] {
            background: #007bff;
            color: #fff;
        }
        button[type="submit"]:hover {
            background: #0056b3;
        }
        .cancel-btn {
            background: #e0e0e0;
            color: #333;
            text-decoration: none;
        }
        .cancel-btn:hover {
            background: #bdbdbd;
        }
        .mensaje-error {
            background: #ffeaea;
            color: #d32f2f;
            border: 1px solid #ffcdd2;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="edit-container">
        <h2>Editar Comentario</h2>
        <?php if ($mensaje): ?>
            <div class="mensaje-error"><?= htmlspecialchars($mensaje) ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?= htmlspecialchars($nombre) ?>" required>
            </div>
            <div class="form-group">
                <label>Comentario:</label>
                <textarea name="comentario" required><?= htmlspecialchars($comentario) ?></textarea>
            </div>
            <div class="btn-group">
                <button type="submit">Guardar Cambios</button>
                <a class="cancel-btn" href="crud.php?section=comentarios">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>