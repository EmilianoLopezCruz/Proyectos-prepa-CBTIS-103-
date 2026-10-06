<?php
include('cnn.php');
$state="";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['nom_usuario'];
    $email = $_POST['correo_usuario'];
    $password = password_hash($_POST['clave_usuario'],PASSWORD_DEFAULT,['cost' => 10]);
    // Verificar si el usuario o el correo ya existen
    $stmt = $cnn->prepare("SELECT id_usuario FROM Usuarios WHERE nom_usuario =:usuario OR correo_usuario =:correo");
    $stmt->bindParam(':usuario', $username);
    $stmt->bindParam(':correo', $username);
    $stmt->execute();
    // $stmt->store_result();
    $resultados=$stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo'1';
    if ($stmt->rowCount() > 0) {
        $state="El usuario o el correo ya existen.";
    } else {
            // echo'2';
        $stmt2 = $cnn->prepare("INSERT INTO Usuarios (nom_usuario, correo_usuario, clave_usuario) VALUES (:usuario,:email,:contrasenia)");
        $stmt2->bindParam(":usuario", $username);
        $stmt2->bindParam(":email",$email);
        $stmt2->bindParam(":contrasenia",$password);
        $stmt2->execute();
        // echo'3';
        if ($stmt2->rowCount()>=1) {
            $state="Cuenta creada exitosamente.";
            header('Location:Login_Modamex.php');
            exit();

        } else {
            $state="Error al registrar el usuario.";
        }
    }
}
?>
<!--  -->
<!--  -->
<!--  -->
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Regístrate - Modamex </title>
        <link rel="stylesheet" href="Estilos_LoginYRegistro_Modamex.css"><!-- Archivo CSS -->
        <script src="Transiciones_Modamex.js" defer></script><!-- Archivo JS -->
    </head>
    <body>
        <div class="contenedor_general"><!-- Contenedor general para las 2 secciones del login (Uno es para donde va el logo y el otro para el formulario) -->
            <div class="seccion_logo"><!-- Sección para el logo de Modamex -->
                <div class="logo">
                    <img src="Imagenes/Logo_Modamex.jpg" alt="Modamex"> <!-- Logo Modamex -->
                </div>
            </div>
            <div class="seccion_formulario"><!-- Sección del formulario para registrarse -->
                <h2> Regístrate </h2>
                <form action="RegistrarCuenta_Modamex.php" method="post">
                    <input type="text" placeholder="Usuario" name="nom_usuario" required> <!-- Campo para Nombre -->
                    <div class="contenedor_del_ojito"> <!-- Campo para Contraseña -->
                        <input type="password" id="password" name="clave_usuario" placeholder="Contraseña" required>
                        <button type="button" id="ojito" class="btn_ojito">
                            <img src="Imagenes/Se ve.png" width="30">
                        </button>
                    </div>
                    <input type="email" placeholder="Correo" name="correo_usuario" required> <!-- Campo para Correo -->
                    <button type="submit" class="btn" name="submit"> Registrar </button> <!-- Botón para Registrarse -->
                </form>
                <!-- Link para registrarse -->               
                <p> ¿Ya tienes cuenta? <a href="Login_Modamex.php" class="trasicion_link"> Inicia sesión </a></p>
                <?php
                if($state=="El usuario o el correo ya existen."){
                    echo '<p style="color: crimson;">'.$state.'</p>';
                    $state="";
                }
                if($state=="Cuenta creada exitosamente."){
                    echo '<p style="color: crimson;">'.$state.'</p>';
                    $state="";

                }
                if($state=="Error al registrar el usuario."){
                    echo '<p style="color: crimson;">'.$state.'</p>';
                    $state="";
                }
                ?>
            </div>
        </div>
    </body>
</html>