<?php
include('cnn.php');

$passwordChangeMessage = ""; // Variable para mostrar el mensaje

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['token'])) {
    $token = $_GET['token'];

    // Validar token
    $stmt = $cnn->prepare("SELECT email, expiration FROM ResetTokens WHERE token = :token");
    $stmt->bindParam(":token", $token);
    $stmt->execute();
    $tokenData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($tokenData && strtotime($tokenData['expiration']) > time()) {
        // Token válido, mostrar formulario para cambiar contraseña
        $email = $tokenData['email'];
    } else {
        echo "Token inválido o expirado.";
        exit();
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $newPassword = password_hash($_POST['nueva_clave'], PASSWORD_DEFAULT);

    // Validar token y actualizar contraseña
    $stmt = $cnn->prepare("SELECT email FROM ResetTokens WHERE token = :token");
    $stmt->bindParam(":token", $token);
    $stmt->execute();
    $email = $stmt->fetchColumn();

    if ($email) {
        $stmt = $cnn->prepare("UPDATE Usuarios SET clave_usuario = :newPassword WHERE correo_usuario = :email");
        $stmt->bindParam(":newPassword", $newPassword);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        // Eliminar token usado
        $stmt = $cnn->prepare("DELETE FROM ResetTokens WHERE token = :token");
        $stmt->bindParam(":token", $token);
        $stmt->execute();

        $passwordChangeMessage = "Contraseña actualizada con éxito. <a href='Login_Modamex.php'>Iniciar sesión</a>";
    } else {
        $passwordChangeMessage = "Token inválido.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña - Modamex</title>
    <link rel="stylesheet" href="Estilos_LoginYRegistro_Modamex.css">
</head>
<body>
    <div class="contenedor_general">
        <div class="seccion_formulario">
            <h2>Restablecer Contraseña</h2>

            <!-- Formulario de cambio de contraseña -->
            <form action="Restablecer.php" method="post">
                <input type="password" placeholder="Nueva Contraseña" name="nueva_clave" required>
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                <button type="submit" class="btn">Restablecer</button>
            </form>
            <br><br>
            <!-- Mostrar mensaje de éxito o error -->
            <?php if (!empty($passwordChangeMessage)): ?>
                <div class="mensaje success">
                    <?php echo $passwordChangeMessage; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</body>
</html>
