<?php
session_start();
$productos = $_SESSION['productos_filtrados'] ?? [];
?>

<?php
    include('nav_bar.php');
    ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados</title>
    <link rel="stylesheet" href="EstilosModamex.css"> <!-- Hacer otro css, o ese mismo para el diseño de las cards de los resultados de los filtros -->
</head>
<body>
    <h1>Resultados de búsqueda</h1>

    <div class="galeria">
        <?php if (count($productos) > 0): ?>
            <?php foreach ($productos as $producto): ?>
                <div class="imagenVestido">
                    <img style="width: 33.33%; height: 150px;" src="<?php echo htmlspecialchars($producto['img_vestido']); ?>" alt="<?php echo htmlspecialchars($producto['nom_vestido']); ?>">
                    <h3><?php echo htmlspecialchars($producto['nom_vestido']); ?></h3>
                    <p>Precio: $<?php echo htmlspecialchars($producto['precio_vestido']); ?></p>
                    <p>Categoría: <?php echo htmlspecialchars($producto['nom_categoria']); ?></p>
                    <p>Color: <?php echo htmlspecialchars($producto['nom_color']); ?></p>
                    <p>Diseñador: <?php echo htmlspecialchars($producto['nom_diseñador']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No se encontraron productos.</p>
        <?php endif; ?>
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
                    <li><strong> Correo: </strong> contacto@modamex.com </li>
                    <li><strong> Teléfono: </strong> +52 55 1234 5678 </li>
                    <li><strong> WhatsApp: </strong> +52 55 8765 4321 </li>
                </ul>
            </div>
            <!-- Sección de redes sociales -->
            <div class="redesSociales">
                <h3> Síguenos </h3>
                <ul class="logoRedes">
                    <li><a href="https://facebook.com/modamex" target="_blank"><img src="Imagenes/facebook.png" alt="Facebook"></a> Facebook </li>
                    <li><a href="https://instagram.com/modamex" target="_blank"><img src="Imagenes/instagram.png" alt="Instagram"></a> Instagram </li>
                    <li><a href="https://twitter.com/modamex" target="_blank"><img src="Imagenes/twitter.png" alt="Twitter"></a> Twitter </li>
                    <li><a href="https://wa.me/525587654321" target="_blank"><img src="Imagenes/whatsapp.png" alt="WhatsApp"></a> WhatsApp </li>
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
