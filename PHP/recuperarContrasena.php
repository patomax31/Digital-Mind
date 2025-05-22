<?php
// Configuración de constantes para el correo
define('CORREO_HOST', 'smtp.gmail.com');
define('CORREO_PORT', 465);
define('ENVIA_GMAIL', 'digitalmindsocials@gmail.com');
define('CORREO_PASS', 'pmhu poud bpkt attz');
define('MY_WEB', 'Digital Mind');

// Conexión a la base de datos
require_once __DIR__ . "../PHP/blog_db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

// Verificar si se envió el campo "email"
if (!isset($_POST['email'])) {
    die("Error: No se recibió el correo electrónico.");
}

$email = trim($_POST['email']);

// Preparar la consulta para buscar al usuario
$query = $conn->prepare("SELECT id, nombre, email FROM usuarios WHERE email = ?");
if (!$query) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$query->bind_param("s", $email);
$query->execute();
$result = $query->get_result();

if ($result === false) {
    die("Error en la consulta SQL: " . $conn->error);
}

// Verificar que el usuario existe
if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();

    // Generar token único para recuperación (32 caracteres en hexadecimal)
    $token = bin2hex(random_bytes(16));
    // Establecer la expiración del token a 1 hora
    $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));
    
    // Actualizar el usuario con el token y la fecha de expiración
    $update_query = $conn->prepare("UPDATE usuarios SET reset_token = ?, token_expires = ? WHERE id = ?");
    if (!$update_query) {
        die("Error en la preparación de la actualización: " . $conn->error);
    }
    $update_query->bind_param("ssi", $token, $expiry, $usuario['id']);
    if (!$update_query->execute()) {
         die("Error al guardar el token de recuperación: " . $conn->error);
    }
    
    // Construir el enlace de recuperación con el token
    $reset_link = "http://localhost/digital-mind/PHP/resetPassword.php?token=" . urlencode($token);
    
    // Configurar y enviar el correo de recuperación
    $mail = new PHPMailer(true);

    try {
        // Puedes activar el debug si lo deseas
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

        $mail->isSMTP();
        $mail->Host       = CORREO_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = ENVIA_GMAIL;
        $mail->Password   = CORREO_PASS;
        
        // Para Gmail en el puerto 465 se utiliza cifrado SSL
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = CORREO_PORT;
        
        // Opcional: desactivar la verificación de certificados en entornos locales
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer'       => false,
                'verify_peer_name'  => false,
                'allow_self_signed' => true
            )
        );
        
        $mail->CharSet  = 'UTF8';
        $mail->Encoding = 'quoted-printable';

        // Configurar remitente y destinatario
        $mail->setFrom(ENVIA_GMAIL, MY_WEB);
        $mail->addAddress($usuario['email'], $usuario['nombre']);

        // Contenido del correo: se envía un enlace que contiene el token y también se muestra el token
        $mail->isHTML(true);
        $mail->Subject = 'Recuperación de contraseña';
        $mail->Body    = 'Hola ' . htmlspecialchars($usuario['nombre']) . ',<br><br>' .
                         'Hemos recibido una solicitud para restablecer tu contraseña.<br><br>' .
                         'Haz clic en el siguiente enlace para recuperar tu contraseña:<br>' .
                         '<a href="' . $reset_link . '">Restablecer mi contraseña</a><br><br>' .
                         'Si el enlace no funciona, copia y pega el siguiente código en la página de restablecimiento:<br>' .
                         '<strong>' . $token . '</strong><br><br>' .
                         'Nota: Este código expirará en 1 hora.<br><br>' .
                         'Si no solicitaste este cambio, ignora este mensaje.<br><br>' .
                         'Saludos,<br>' . MY_WEB;
        $mail->AltBody = 'Hola ' . $usuario['nombre'] . ', ' .
                         'Visita el siguiente enlace para restablecer tu contraseña: ' . $reset_link .
                         "\nSi el enlace no funciona, copia y pega el siguiente código: " . $token .
                         "\nNota: Este código expirará en 1 hora.\nSi no solicitaste este cambio, ignora este mensaje.";

        $mail->send();
        
        // Mostrar mensaje de éxito decorado con CSS y una palomita de aprobación
        echo "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Mensaje Enviado</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f2f2f2;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                }
                .success-message {
                    background-color: #d4edda;
                    border: 1px solid #c3e6cb;
                    color: #155724;
                    padding: 20px;
                    text-align: center;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                    max-width: 400px;
                }
                .success-message .check-icon {
                    font-size: 40px;
                    color: #28a745;
                    vertical-align: middle;
                    margin-bottom: 10px;
                }
                .link-reset {
                    margin-top: 15px;
                    display: block;
                    font-size: 14px;
                    color: #007bff;
                    text-decoration: none;
                }
                .link-reset:hover {
                    text-decoration: underline;
                }
            </style>
        </head>
        <body>
            <div class='success-message'>
                <div class='check-icon'>&#x2714;</div>
                <p>Mensaje enviado con éxito a " . htmlspecialchars($usuario['email']) . "</p>
                <p>Para recuperar tu contraseña, haz clic en el siguiente enlace:</p>
                <a class='link-reset' href='" . $reset_link . "'>" . $reset_link . "</a>
            </div>
        </body>
        </html>";
        
    } catch (Exception $e) {
        echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
    }
} else {
    echo "No se encontró un usuario con ese correo.";
}
?>