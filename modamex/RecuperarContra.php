<?php
include('cnn.php');
$passwordState = "";
$mensajeClase = ""; // Para aplicar la clase CSS

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email_recuperacion'];

    $stmt = $cnn->prepare("SELECT correo_usuario FROM Usuarios WHERE correo_usuario = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $token = bin2hex(random_bytes(50));
        $expiration = date("Y-m-d H:i:s", strtotime('+1 hour'));
        
        $stmt = $cnn->prepare("INSERT INTO ResetTokens (email, token, expiration) VALUES (:email, :token, :expiration)");
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":token", $token);
        $stmt->bindParam(":expiration", $expiration);
        $stmt->execute();

        $link = "Restablecer.php?token=$token";
        $passwordState = "Enlace de restablecimiento enviado: <a href='$link'>Haz clic aquí para restablecer tu contraseña</a>";
        $mensajeClase = "success";
    } else {
        $passwordState = "Correo no registrado.";
        $mensajeClase = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - Modamex</title>
    <link rel="stylesheet" href="Estilos_LoginYRegistro_Modamex.css">
    <style>
        
    </style>
</head>
<body>
    <div class="contenedor_general">
        <div class="seccion_formulario">
            <h2>Recuperar Contraseña</h2>
            <form action="RecuperarContra.php" method="post">
                <input type="email" placeholder="Ingresa tu correo" name="email_recuperacion" required>
                <button type="submit" class="btn">Enviar Enlace</button>
            </form>
            <br><br>
            <div class="mensaje <?php echo $mensajeClase; ?>">
                <?php echo $passwordState; ?>
            </div>
            <p><a href="Login_Modamex.php" class="trasicion_link">Volver al inicio de sesión</a></p>
        </div>
    </div>
</body>
</html>
