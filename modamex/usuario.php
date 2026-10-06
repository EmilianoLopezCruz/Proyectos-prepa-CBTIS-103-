<?php
$servername = "localhost";  // Cambia esto si tu servidor no es localhost
$username = "u481415426_admin";         // Usuario de la base de datos
$password = "#Unaclavetodalargota1";             // Contraseña de la base de datos (vacía en XAMPP por defecto)
$dbname = "u481415426_ModaMexDos";  // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('Location:Login_Modamex.php');
} else {
    $user_id = $_SESSION['id_usuario'];
    // var_dump($user_id);
}
// Obtener la información del usuario
$sql = "SELECT * FROM Usuarios WHERE id_usuario = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    // var_dump($usuario);
} else {
    echo "Usuario no encontrado.";
    exit();
}

//obtencion de imagen para colocarse en el html.
$stmt = "SELECT imagen_perfil FROM Usuarios WHERE id_usuario = '$user_id'";
$result = $conn->query($stmt);
foreach ($result as $path) {
    $direccion = $path['imagen_perfil'];
}
// Verificar si se ha enviado el formulario para actualizar los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $profImage = $_FILES["input_file"]['name'];
    // Validar la fecha de nacimiento
    // Si la fecha es válida, actualizar los datos del usuario en la base de datos
    if (isset($_FILES['input_file']) && $_FILES['input_file']['error'] == UPLOAD_ERR_OK) { //verificar si se subió una foto
        // Obtiene información del archivo
        $nombreArchivo = $_FILES['input_file']['name']; //nombre del archivo en el navegador temp
        $tmpArchivo = $_FILES['input_file']['tmp_name']; //direccion temp en el navegador
        $rutaDestino = 'profImg/' . basename($nombreArchivo);

        // Crea la carpeta 'img' si no existe
        if (!is_dir('profImg')) {
            mkdir('profImg', 0777, true);
        }
        //Adicion a la DB, para usarse como ruta de acceso futura.
        $update_sql = "UPDATE Usuarios SET nom_usuario = '$nombre_usuario', correo_usuario = '$email',telefono_usuario = '$telefono', imagen_perfil = '$rutaDestino' WHERE id_usuario = $user_id";
        // Mueve el archivo a la carpeta de destino
        if (move_uploaded_file($tmpArchivo, $rutaDestino)) {
            echo "La imagen se ha subido correctamente: " . htmlspecialchars($rutaDestino);
        } else {
            echo "Error al mover el archivo.";
        }
    } else {
        //Adicion a la DB, para usarse como ruta de acceso futura.
        $update_sql = "UPDATE Usuarios SET nom_usuario = '$nombre_usuario', correo_usuario = '$email',telefono_usuario = '$telefono' WHERE id_usuario = $user_id";
    }

    if ($conn->query($update_sql) === TRUE) {
        // echo "Datos actualizados correctamente.";
        // Actualizamos los datos del usuario en la sesión (nombre_usuario)
        $_SESSION['nombre_usuario'] = $nombre_usuario;
    } else {
        echo "Error al actualizar los datos: " . $conn->error;
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Usuario v2</title>
    <link rel="stylesheet" href="usuario.css">
</head>

<body>
    <!-- insercion de nav usando php -->
    <?php
    include('nav_bar_index.php');
    ?>
    <!--Contenedor principal-->
    <!-- regresar boton -->
    
    <div class="ContenedorPrincipal">
    <a class="hola" href="index.php">
        <div class="arrow-top"></div>
        <div class="arrow-bottom"></div>
    </a>
        <!--Contenedor Izquierdo-->
        <div class="ContenedorIzq">
            <!--Nombre del Usuario-->
            <h2>Perfil de:</h2>
            <p class="nombre" id="usernameLabel">NomUsuario</p>

            <!--Foto de Perfil-->
            <div class="fotoDePerfil">
                <?php echo '<img src="' . $direccion . '" alt="Foto de perfil" class="fotoPerfil" id="fotoPerfil">';  ?>
                <!-- <div class="overlay" id="cambiarFotoOverlay"> Cambiar foto </div> -->
            </div>
        </div>
        <!--Contenedor Derecho-->
        <div class="ContenedorDer">
            <form id="userForm" method="post" action="usuario.php" enctype="multipart/form-data">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre_usuario" value="<?php echo $usuario["nom_usuario"]; ?>">
                <label for="Telefono">Telefono</label>
                <input type="text" name="telefono" id="Telefono" value="<?php echo $usuario["telefono_usuario"]; ?>">
                <label for="correo">Correo</label>
                <input type="email" id="correo" name="email" value="<?php echo $usuario["correo_usuario"]; ?>">
                <input type="file" name="input_file" id="">

                <!--JS de Transformación NomUser-->

                <button type="submit" id="guardar" class="botones">Guardar cambios</button>

            </form>
            <form action="logout.php" method="post">
                <button type="submit" id="restaurar" class="botones">Cerrar sesion</button>
            </form>
        </div>
    </div>
    <!-- Footer -->
    <footer class="footer">
        <div class="contenedorFooter">
            <!-- Información general de Modamex -->
            <div class="infoModamex">
                <img src="Imagenes/logoColibri.png" alt="Modamex Logo" class="logoColibri">
                <p> En <strong>Modamex</strong>, nos dedicamos a ofrecerte los mejores vestidos para cualquier ocasión. Calidad, estilo y diseño en un solo lugar. </p>
            </div>
            <!-- Sección de contactanos -->
            <div class="contactos">
                <h3> Contáctanos </h3>
                <ul>
                    <li><strong> Correo: </strong> contacto @modamex.com </li>
                    <li><strong> Teléfono: </strong> +52 1 56 5430 6947 </li>
                    <li><strong> WhatsApp: </strong> +52 1 56 5430 6947 </li>
                    <a href="politicas.html">
                        <li><strong> Política de privacidad </strong></li>
                    </a>
                    <a href="aboutme.html">
                        <li><strong> Acerca de </strong></li>
                    </a>
                </ul>
            </div>
            <!-- Sección de redes sociales -->
            <div class="redesSociales">
                <h3> Síguenos </h3>
                <ul class="logoRedes">
                    <li><a href="https://www.facebook.com/profile.php?id=61569957186204&rdid=hCXxgrUcxZ9CV8ox&share_url=https%3A%2F%2Fwww.facebook.com%2Fshare%2FaxdoEJhLeaeTSQzX%2F" target="_blank"><img src="Imagenes/facebook.png" alt="Facebook"></a> Facebook </li>
                    <li><a href="https://www.instagram.com/modamex_real?igsh=N3djeDBlOXFjbHZ3" target="_blank"><img src="Imagenes/instagram.png" alt="Instagram"></a> Instagram </li>
                    <li><a href="https://twitter.com/modamex" target="_blank"><img src="Imagenes/twitter.png" alt="Twitter"></a> Twitter </li>
                    <li><a href="https://whatsapp.com/channel/0029VatuPvTI1rcnwnBXuR36" target="_blank"><img src="Imagenes/whatsapp.png" alt="WhatsApp"></a> WhatsApp </li>
                </ul>
            </div>
            <!-- Sección de categorías -->
            <div class="secciones">
                <h3> Vestidos </h3>
                <ul>
                    <li><a href="#"> Cóctel </a></li>
                    <li><a href="#"> XV años </a></li>
                    <li><a href="#"> Boda </a></li>
                    <li><a href="#"> Noche </a></li>
                </ul>
            </div>
        </div><br>
        <!-- Derechos de autor -->
        <div class="derechos">
            <p><b> &copy; 2024 Modamex. Todos los derechos reservados. </b></p>
        </div>
    </footer>

</body>

</html>