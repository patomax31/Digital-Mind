<?php
session_start();
include("blog_db.php");

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: ../PHP/login.php");
    exit();
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['nombre']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
        $nombre = trim($_POST['nombre']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mensaje = "<p class='message error'>Correo electrónico no válido.</p>";
        } elseif ($password !== $confirm_password) {
            $mensaje = "<p class='message error'>¡Las contraseñas no coinciden!</p>";
        } elseif (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
            $mensaje = "<p class='message error'>La contraseña debe tener al menos 8 caracteres, una mayúscula y un número.</p>";
        } else {
            $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $mensaje = "<p class='message error'>¡Este correo ya está registrado!</p>";
            } else {
                $password_hashed = password_hash($password, PASSWORD_BCRYPT);

                $insert = $conn->prepare("INSERT INTO admin (nombre, email, contraseña) VALUES (?, ?, ?)");
                $insert->bind_param("sss", $nombre, $email, $password_hashed);

                if ($insert->execute()) {
                    $_SESSION['mensaje_bienvenida'] = "Administrador creado exitosamente.";
                    header("Location: crud.php");
                    exit();
                } else {
                    $mensaje = "<p class='message error'>Error al registrar administrador: " . $conn->error . "</p>";
                }
                $insert->close();
            }
            $stmt->close();
        }
    } else {
        $mensaje = "<p class='message error'>Completa todos los campos.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Administrador</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .form-container {
            max-width: 400px;
            margin: 40px auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            width: 100%;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .message.error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background:rgb(41, 100, 128);
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background:rgb(73, 169, 174);
        }

        .btn-regresar {
            display: inline-block;
            text-align: center;
            padding: 10px 20px;
            background-color: #444;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 15px;
            transition: background-color 0.3s ease;
        }

        .btn-regresar:hover {
            background-color: #222;
            color:rgb(73, 169, 174);
        }

        .center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Crear Administrador</h2>
        <?= $mensaje ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" required>
            </div>

            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirmar contraseña</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>

            <button type="submit">Crear Administrador</button>
        </form>

        <div class="center">
            <a href="crud.php" class="btn-regresar">← Regresar</a>
        </div>
    </div>
</body>
</html>
