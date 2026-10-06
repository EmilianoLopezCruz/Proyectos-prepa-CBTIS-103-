<?php
//REPORTE DE ERRORES
ini_set('display_errors', 1);
error_reporting(E_ALL);

//REVISION DE SESION (MARCO)
session_start();
if(!isset($_SESSION['id_usuario'])){
    header('Location:Login_Modamex.php');
}

//VARIABLES (ABRAHAM)
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 && $_GET['id'] <= 60) {
    $idvestido = $_GET['id'];
} else {
    // Redirigir a error.php si no existe, no es numérico o es negativo
    header('Location: error.html');
    exit();
}

include 'cnn.php'; //conexion.php

// Preparar y ejecutar la consulta
$queryvestidos = $cnn->prepare("SELECT v.id_vestido AS ID, 
    v.nom_vestido AS 'Nombre',
    c.nom_categoria AS 'Categoria',
    col.nom_color AS 'Color',
    dsg.nom_diseñador AS 'Diseñador',
    v.precio_vestido AS 'Precio',
    v.img_vestido AS 'RutaImg'
    FROM Vestidos AS v
    JOIN Categoria AS c ON v.id_cat_vestido = c.id_categoria
    JOIN Colores AS col ON v.id_color_vestido = col.id_color
    JOIN Diseñadores AS dsg ON v.id_dsg_vestido = dsg.id_diseñador
    WHERE v.id_vestido = :id");
$queryvestidos->execute([':id' => $idvestido]);
$queryacces = $cnn->prepare("SELECIONAR LOS DATOS DEL ACCESORIO; NOMBRE PRECIO IMAGEN DISEÑADOR");

$datosvestido = $queryvestidos->fetch(PDO::FETCH_ASSOC);

?>
<script>
function toggleWishlist(element) {
    const vestidoId = element.getAttribute('data-id');
    const isAdded = element.getAttribute('data-wishlist') === 'true';

    // Configuración del endpoint PHP
    const url = 'wishlist_handler.php';
    const action = isAdded ? 'remove' : 'add';

    // Enviar la solicitud AJAX
    fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: vestidoId, action: action })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Cambiar el estado visual del ícono
            element.setAttribute('data-wishlist', !isAdded);
            element.src = !isAdded ? 'eq2_iconos/corazon_relleno.png' : 'eq2_iconos/corazon.png';
        } else {
            console.error('Error:', data.message);
        }
    })
    .catch(error => console.error('Error en el fetch:', error));
}
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Diseño </title>
    <link rel="stylesheet" href="vestido.css">
</head>

<body>
    <!-- insercion de nav usando php -->
    <?php
    include('nav_bar.php');
    ?>

    <div class="cuerpo">
        <div></div>
        <article class="imagenes_vestido">
            <!--<div class="img_1">-->
            <!--    <p style="font-size: 25px; font-weight: bold;">Completa tu outfit:</p><br><br>-->
            <!--    <div class="contenedorImagen">-->
            <!--        <img src="Imagenes/imagen.png" style="background-color:white;>-->
            <!--        <p class="acNombre">Nombre</p>-->
            <!--        <p class="acPrecio">Precio</p>-->
            <!--        <p class="acDiseñador">Diseñador</p>-->
            <!--    </div><br><br>-->
            <!--    <div class="contenedorImagen">-->
            <!--        <img src="Imagenes/imagen.png" style="background-color:white;>-->
            <!--        <p class="acNombre">Nombre</p>-->
            <!--        <p class="acPrecio">Precio</p>-->
            <!--        <p class="acDiseñador">Diseñador</p>-->
            <!--    </div><br><br>-->
            <!--</div> BANEADO-->
            <div class="img_2">
                <div class="contenedorImagen">
                    <img src="<?php echo htmlspecialchars($datosvestido['RutaImg']); ?>" style="background-color:white;">
                </div>
            </div>
        </article>
        <div></div>
        <div class="textos">
            <br>
            <div class="contenedorTexto"> <label class="nombre"><?php echo htmlspecialchars($datosvestido['Nombre']); ?></label> </div>
            <div class="contenedorTexto"> <label class="descripcion">Diseño por <?php echo htmlspecialchars($datosvestido['Diseñador']); ?></label> </div>
            <div class="contenedorTexto"> <label class="precio">$<?php echo htmlspecialchars($datosvestido['Precio']); ?></label> </div>
            
            <div class="contenedorAñadir">
                <form action="agregar_carrito.php" method="POST">
                    <input type="hidden" name="id_producto" value="<?php echo $datosvestido['ID']; ?>">
                    <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($datosvestido['Nombre']); ?>">
                    <input type="hidden" name="precio" value="<?php echo $datosvestido['Precio']; ?>">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" name="cantidad" id="cantidad" value="1" min="1">
                    <button class="anadir_carrito" type="submit">Añadir al carrito</button>
                </form>
                <?php
                $isInWishlist = $cnn->prepare("SELECT COUNT(*) FROM Wishlist WHERE id_usuario_w = :id_usuario AND id_articulo_w = :id_vestido;");
                $isInWishlist->execute([':id_usuario' => $_SESSION['id_usuario'], ':id_vestido' => $datosvestido['ID']]);
                $isInWishlist = $isInWishlist->fetchColumn() > 0;
                
                $dataWishlist = $isInWishlist ? 'true' : 'false';
                $iconoSrc = $isInWishlist ? 'eq2_iconos/corazon_relleno.png' : 'eq2_iconos/corazon.png';
                ?>
                <img 
                    src="<?php echo $iconoSrc; ?>" 
                    alt="Corazon" 
                    class="icono_cora" 
                    data-id="<?php echo htmlspecialchars($datosvestido['ID']); ?>" 
                    data-wishlist="<?php echo $dataWishlist; ?>" 
                    onclick="toggleWishlist(this)">

            </div>
            <!--<div class="contenedorTexto"> <label class="talla">Tallas disponibles</label>-->
            
            <!--<div class="contenedorTexto">-->
            <!--<input class="tallas" value="CH" type="button">-->
            <!--<input class="tallas" value="MED" type="button">-->
            <!--<input class="tallas" value="G" type="button">-->
            <!--</div>-->
            <!-- Formulario para agregar al carrito -->
            <!--<div class="contenedorAñadir">-->
            <!--    <input class="anadir_carrito" type="button" value="Añadir al carrito">-->
            <!--    <img src="eq2_iconos/corazon.png" alt="Corazon" class="icono_cora"> -->
            <!--</div>-->
            
        </div>
    </div>
        
    </div><br><br><br>
    
    <footer class="footer">
        <div class="contenedorFooter">
            <!-- Información general de Modamex -->
            <div class="infoModamex">
                <img src="Imagenes/logoColibri.png" alt="Modamex Logo" class="logoColibri">
                <p> En <strong>Modamex</strong>, nos dedicamos a ofrecerte los mejores vestidos para cualquier ocasión.
                    Calidad, estilo y diseño en un solo lugar. </p>
            </div>
            <!-- Sección de contactanos -->
            <div class="contactos">
                <h3> Contáctanos </h3>
                <ul>
                    <li><strong> Correo: </strong> contacto@modamex.com </li>
                    <li><strong> Teléfono: </strong> +52 55 1234 5678 </li>
                    <li><strong> WhatsApp: </strong> +52 55 8765 4321 </li>
                </ul>
            </div>
            <!-- Sección de redes sociales -->
            <div class="redesSociales">
                <h3> Síguenos </h3>
                <ul class="logoRedes">
                    <li><a href="https://facebook.com/modamex" target="_blank"><img src="Imagenes/facebook.png"
                                alt="Facebook"></a> Facebook </li>
                    <li><a href="https://instagram.com/modamex" target="_blank"><img src="Imagenes/instagram.png"
                                alt="Instagram"></a> Instagram </li>
                    <li><a href="https://twitter.com/modamex" target="_blank"><img src="Imagenes/twitter.png"
                                alt="Twitter"></a> Twitter </li>
                    <li><a href="https://wa.me/525587654321" target="_blank"><img src="Imagenes/whatsapp.png"
                                alt="WhatsApp"></a> WhatsApp </li>
                </ul>
            </div>
            <!-- Sección de categorías -->
            <div class="secciones">
                <h3> Vestidos </h3>
                <ul>
                    <li><a href="#"> Casuales </a></li>
                    <li><a href="#"> De Gala </a></li>
                    <li><a href="#"> Cóctel </a></li>
                    <li><a href="#"> Formales </a></li>
                </ul>
            </div>
        </div><br>
        <!-- Derechos de autor -->
        <div class="derechos">
            <p><b> &copy; 2024 Modamex. Todos los derechos reservados. </b></p>
        </div>
    </footer>
</body>