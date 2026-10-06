<?php
include('cnn.php');
//Lo siguiente irá en la pagina de perfil, pero por mientras va aqui.
// if(!isset($_SESSION['user_id'])){
//     header('Location:Login_Modamex.php');

// }
$passwordState="";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['nom_usuario'];
    $password = $_POST['clave_usuario'];
    // Consulta para verificar el usuario
    $stmt = $cnn->prepare("SELECT clave_usuario,id_usuario,nom_usuario FROM Usuarios WHERE nom_usuario =:usuario OR correo_usuario =:usuario");
    $stmt->bindParam(":usuario", $username);
    $stmt->execute();
    $resultados=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($resultados as $resultado){
        $hashed_password=$resultado['clave_usuario'];
        $id_user=$resultado['id_usuario'];
        $nombre_usuario_Db=$resultado['nom_usuario'];
    }

    // Comprobar si hay resultados
    if ($stmt->rowCount() >0) {
        if (password_verify($password, $hashed_password)) {
            // Respuesta en caso de éxito
            $passwordState="Success";
            session_start();
            $_SESSION['id_usuario'] = $id_user;
            $_SESSION['nombre_usuario'] = $nombre_usuario_Db;
            header('Location:index.php');
            exit();

        } else {
            // Contraseña incorrecta
            $passwordState="Contraseña Incorrecta.";
        }
    } else {
        // Usuario no encontrado
        $passwordState="Usuario no encontrado";
    }
}
?>
<!--  -->
<!--  -->
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Inicio Sesión - Modamex </title>
        <link rel="stylesheet" href="Estilos_LoginYRegistro_Modamex.css"><!-- Archivo CSS -->
        <script src="Transiciones_Modamex.js" defer></script><!-- Archivo JS -->
    </head>
    <body>
        <div class="contenedor_general"><!-- Contenedor general para las 2 secciones del login (Uno es para donde va el logo y el otro para el formulario) -->
            <div class="seccion_formulario"><!-- Sección del formulario para inicio de sesión -->
                <h2> Hola! <br> Bienvenido a Modamex </h2>
                <form action="Login_Modamex.php" method="post">
                    <input type="text" placeholder="Usuario" name="nom_usuario"required> <!-- Campo para Nombre -->
                    <div class="contenedor_del_ojito"> <!-- Campo para Contraseña -->
                        <input type="password" id="password" name="clave_usuario" placeholder="Contraseña" required>
                        <button type="button" id="ojito" class="btn_ojito">
                            <img src="Imagenes/Se ve.png" width="30">
                        </button>
                    </div>
                    <button type="submit" name="submit "class="btn"> Iniciar Sesión </button> <!-- Botón para Iniciar sesion -->
                </form>
                <!-- Link para registrarse -->
                <p> ¿No tienes cuenta? <a href="RegistrarCuenta_Modamex.php" class="trasicion_link"> Regístrate </a></p>
                <p><a href="RecuperarContra.php" class="trasicion_link">¿Olvidaste tu contraseña?</a></p>
                <?php
                if($passwordState=="Success"){
                   echo '<p style="color: crimson;">'.$passwordState.'</p>';
                    $passwordState="";
                }
                if($passwordState=="Contraseña Incorrecta."){
                   echo '<p style="color: crimson;">'.$passwordState.'</p>';
                    $passwordState="";

                }
                if($passwordState=="Usuario no encontrado"){
                   echo '<p style="color: crimson;">'.$passwordState.'</p>';
                    $passwordState="";
                }
                ?>
            </div>
            <!-- Sección para el logo de Modamex -->
            <div class="seccion_logo">
                <div class="logo">
                    <img src="Imagenes/Logo_Modamex.jpg" alt="Modamex"> <!-- Logo Modamex -->
                </div>
            </div>
        </div>
    </body>
</html>
