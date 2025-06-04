<?php
require 'blog_db.php';

// Crear categoría
if (isset($_POST['crear'])) {
    $nombre = $_POST['nombre'];
    $descripcion_corta = $_POST['descripcion_corta'];
    $imagen = '';

    // Manejo de imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $img_name = uniqid() . '_' . basename($_FILES['imagen']['name']);
        $img_path = '../IMG/' . $img_name;
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $img_path)) {
            $imagen = $img_name;
        }
    }

    $stmt = $conn->prepare("INSERT INTO categoria (nombre, descripcion_corta) VALUES (?, ?)");
    $stmt->bind_param("ss", $nombre, $descripcion_corta);
    $stmt->execute();
    header("Location: crud.php?success=1");
    exit();
}

// Editar categoría (mostrar formulario)
if (isset($_GET['editar'])) {
    $id = intval($_GET['editar']);
    $result = $conn->query("SELECT * FROM categoria WHERE id = $id");
    $cat = $result->fetch_assoc();
    ?>
    <form method="POST" action="categoria_crud.php" enctype="multipart/form-data" class="form-categoria">
        <div class="form-row">
            <input type="hidden" name="id" value="<?= $cat['id'] ?>">
            <input type="text" name="nombre" value="<?= htmlspecialchars($cat['nombre']) ?>" required>
            <input type="text" name="descripcion_corta" value="<?= htmlspecialchars($cat['descripcion_corta']) ?>" placeholder="Descripción corta">
            <button type="submit" name="actualizar">Actualizar</button>
            <a href="crud.php?section=categorias" style="margin-left:10px;color:#7a3cff;">Cancelar</a>
        </div>
    </form>

    <style>
body {
  min-height: 100vh;
  margin: 0;
  background: #f4f8fa;
  display: flex;
  align-items: center;
  justify-content: center;
}
.form-categoria {
  background: #f8fcfc;
  border-radius: 18px;
  padding: 36px 38px 28px 38px;
  box-shadow: 0 8px 32px rgba(74,160,162,0.13);
  max-width: 400px;
  width: 100%;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  gap: 18px;
  align-items: stretch;
}
.form-categoria .form-row {
  display: flex;
  flex-direction: column;
  gap: 18px;
}
.form-categoria input[type="text"] {
  padding: 12px 14px;
  border: 1.5px solid #cbe6e7;
  border-radius: 7px;
  font-size: 1.1em;
  outline: none;
  transition: border 0.2s;
}
.form-categoria input[type="text"]:focus {
  border-color: #4aa0a2;
}
.form-categoria .file-label {
  position: relative;
  overflow: hidden;
  display: inline-block;
  background: #eafafa;
  color: #4aa0a2;
  border-radius: 7px;
  padding: 10px 18px;
  cursor: pointer;
  font-weight: 500;
  border: 1.5px solid #cbe6e7;
  transition: background 0.2s, border 0.2s;
  text-align: center;
  width: fit-content;
}
.form-categoria .file-label:hover {
  background: #d4f3f3;
  border-color: #4aa0a2;
}
.form-categoria .file-label input[type="file"] {
  display: none;
}
.form-categoria img {
  width: 48px;
  height: 48px;
  object-fit: cover;
  border-radius: 50%;
  margin: 0 auto;
  display: block;
  border: 2px solid #cbe6e7;
}
.form-categoria button[type="submit"] {
  background: #4aa0a2;
  color: #fff;
  border: none;
  border-radius: 7px;
  padding: 12px 0;
  font-size: 1.1em;
  font-weight: 700;
  cursor: pointer;
  transition: background 0.2s, box-shadow 0.2s;
  margin-top: 8px;
}
.form-categoria button[type="submit"]:hover {
  background: #357c7e;
  box-shadow: 0 2px 8px rgba(74,160,162,0.15);
}
.form-categoria a {
  color: #7a3cff;
  text-align: center;
  margin-top: 8px;
  text-decoration: none;
  font-weight: 500;
}
.form-categoria a:hover {
  text-decoration: underline;
}
</style>
    <?php
    exit();
}

// Actualizar categoría
if (isset($_POST['actualizar']) && !empty($_POST['nombre']) && !empty($_POST['id'])) {
    $id = intval($_POST['id']);
    $nombre = trim($_POST['nombre']);
    $descripcion_corta = trim($_POST['descripcion_corta']);

    $stmt = $conn->prepare("UPDATE categoria SET nombre = ?, descripcion_corta = ? WHERE id = ?");
    $stmt->bind_param("ssi", $nombre, $descripcion_corta, $id);
    $stmt->execute();

    header("Location: crud.php?section=categorias");
    exit();
}

// Eliminar categoría
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $stmt = $conn->prepare("DELETE FROM categoria WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: crud.php?section=categorias");
    exit();
}

// Si no hay acción, redirige al CRUD principal
header("Location: crud.php?section=categorias");
exit();
?>