<?php
include 'cnn.php'; //conexion.php

//REPORTE DE ERRORES
ini_set('display_errors', 1);
error_reporting(E_ALL);


session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('Location:Login_Modamex.php');
}

$frases = array(
    '
Destaca con elegancia en cada ocasión.',
    'Sofisticación que te hará brillar.',
    'El vestido perfecto para deslumbrar.',
    'Glamour que marca tendencia.',
    'Un toque de magia para tu look.',
    'Frescura y estilo en cada paso.',
    'Diseñado para robar miradas.',
    'La combinación perfecta de moda y confort.',
    'Elegancia que habla por sí sola.',
    'La opción ideal para cualquier evento.',
    'Crea momentos memorables con este diseño.',
    'Romántico, único y lleno de estilo.',
    'Un clásico renovado para lucir impecable.',
    'Haz de este vestido tu nuevo favorito.',
    'La prenda que necesitas para destacar.'
);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modamex Carrusel</title>
    <link rel="stylesheet" href="EstilosModamex.css"> <!-- Archivo CSS -->
</head>

<body>
    <!-- Barra de navegación -->
    <!-- insercion de nav usando php -->
    <?php
    include('nav_bar.php');
    ?>

    <br><br><br>
    <!-- Carrusel de mensajes -->
    <div class="contenedorCarrusel">
        <div class="textoCarrusel">
            <p> ¡Bienvenido a Modamex!
                🌟 ¡Tu estilo, nuestra inspiración! 🛒 Explora las mejores tendencias de moda en Modamex. ¡Compra hoy! 🕶️👗
                🎁 ¡Sorpréndete! Modamex tiene todo lo que necesitas para brillar esta temporada 🌟 ¡Compra ahora!
                🚀 Descubre productos únicos al mejor precio 🔥 ¡Compra ahora y sé parte de la experiencia Modamex! 💼✨ </p>
        </div>
    </div><br>
    <a class="hola" href="index.php">
        <div class="arrow-top"></div>
        <div class="arrow-bottom"></div>
    </a>
    <!-- Galería de vestidos -->
    <div class="galeria" id="galeria">
        <?php
        //VARIABLES (ABRAHAM)
        if (isset($_GET['cat']) && is_numeric($_GET['cat']) && $_GET['cat'] > 0) {
            $catVestido = $_GET['cat'];

            $stmtCat = $cnn->prepare('SELECT * FROM Vestidos WHERE id_cat_vestido=:categoria');
            $stmtCat->bindParam(':categoria', $catVestido);
            $stmtCat->execute(['categoria' => $catVestido]);
            $query = $stmtCat->fetchAll(PDO::FETCH_ASSOC);
            if ($stmtCat->rowCount() > 0) {
                $regConHtml = '';
                foreach ($query as $resultado) {
                    $idDiseño = $resultado['id_vestido'];
                    $nombreDiseño = $resultado['nom_vestido'];
                    $direccionDiseño = $resultado['img_vestido'];
                    $regConHtml .= '
        <div class="imagenVestido">
            <div class="contenedorImagen">
                <a href=vestido.php?id=' . $idDiseño . '>
                    <img src="' . $direccionDiseño . '" alt="Vestido ' . $catVestido . '">
                    <div class="descripcion"><b>' . $frases[random_int(0, 14)] . '</b></div>
                </a>
            </div>
            <p><b>' . $nombreDiseño . '</b></p>
        </div>';
                }
                // echo $regConHtml;
                echo ($regConHtml);
            }
        } else {
            // Redirigir a error.php si no existe, no es numérico o es negativo
            echo "<script>
    document.addEventListener('DOMContentLoaded', () => {
        var resultadosContainer = document.getElementById('galeria');

        fetch('sistemaCargaVestidos.php', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                resultadosContainer.innerHTML = '';
                console.log(data);
                resultadosContainer.innerHTML = data;
            })
    });
</script>";
        exit();
        }
        ?>
    </div><br>
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
<script src="mostrarBusqueda.js"></script>

</html>