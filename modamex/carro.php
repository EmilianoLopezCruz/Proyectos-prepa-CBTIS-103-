<?php
session_start();
include 'cnn.php';

// Inicializar totales
$total = 0;
$iva = 0;
$totalConIva = 0;

// Calcular totales si hay productos en el carrito
if (!empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $producto) {
        $total += intval($producto['precio']) * intval($producto['cantidad']);
    }
    $iva = $total * 0.16;
    $totalConIva = $total + $iva;
}

// Eliminar producto del carrito
if (isset($_GET['eliminar']) && isset($_SESSION['carrito'][$_GET['eliminar']])) {
    unset($_SESSION['carrito'][$_GET['eliminar']]);
    header("Location: carro.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="carro.css">
</head>

<body>
    <?php include('nav_bar.php'); ?>

    <div class="contenedor-principal">
        <a class="hola" href="index.php">
            <div class="arrow-top"></div>
            <div class="arrow-bottom"></div>
        </a>
        <h1 class="titulo">Carrito de Compras</h1>
        <p class="subtitulo">Artículos: <?php echo count($_SESSION['carrito'] ?? []); ?></p>
        
        <div class="contenido">
            <div class="galeria">
                <?php if (!empty($_SESSION['carrito'])): ?>
                    <?php foreach ($_SESSION['carrito'] as $id => $producto): ?>
                        <div class="producto">
                            <!-- Imagen del producto -->
                            <img src="<?php echo htmlspecialchars($producto['imagen'] ); ?>"
                                alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="imagen">
                            <!-- Información del producto -->
                            <p><strong><?php echo htmlspecialchars($producto['nombre']); ?></strong></p>
                            <p>Cantidad: <?php echo htmlspecialchars($producto['cantidad']); ?></p>
                            <p>Precio unitario: $<?php echo number_format(floatval($producto['precio']), 2); ?></p>
                            <p>Total: $<?php echo number_format(floatval($producto['precio']) * floatval($producto['cantidad']), 2); ?></p>
                            <!-- Botón para eliminar -->
                            <a href="carro.php?eliminar=<?php echo $id; ?>" class="boton-eliminar">Eliminar</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>El carrito está vacío.</p>
                <?php endif; ?>
            </div>

            <!-- Resumen del pedido -->
            <div class="resumen">
                <br>
                <h2>Resumen del pedido</h2>
                <br>
                <p>Subtotal (sin IVA): $<?php echo number_format($total, 2); ?></p>
                <br>
                <p>IVA (16%): $<?php echo number_format($iva, 2); ?></p>
                <br>
                <p><strong>Total: $<?php echo number_format($totalConIva, 2); ?></strong></p>
                <br>
                <?php if (!empty($_SESSION['carrito'])): ?>
                    <a href="tarjeta.php" class="boton-comprar">Finalizar Compra</a>
                <?php else: ?>
                    <a href="#" class="boton-comprar desactivado" onclick="return false;">Finalizar Compra</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="contenedorFooter">
            <!-- Información general -->
            <div class="infoModamex">
                <img src="Imagenes/logoColibri.png" alt="Modamex Logo" class="logoColibri">
                <p>En <strong>Modamex</strong>, nos dedicamos a ofrecerte los mejores vestidos para cualquier ocasión.
                    Calidad, estilo y diseño en un solo lugar.</p>
            </div>
            <div class="contactos">
                <h3>Contáctanos</h3>
                <ul>
                    <li><strong>Correo:</strong> contacto@modamex.com</li>
                    <li><strong>Teléfono:</strong> +52 55 1234 5678</li>
                    <li><strong>WhatsApp:</strong> +52 55 8765 4321</li>
                </ul>
            </div>
            <div class="redesSociales">
                <h3>Síguenos</h3>
                <ul class="logoRedes">
                    <li><a href="https://facebook.com/modamex" target="_blank"><img src="Imagenes/facebook.png"
                                alt="Facebook"></a> Facebook</li>
                    <li><a href="https://instagram.com/modamex" target="_blank"><img src="Imagenes/instagram.png"
                                alt="Instagram"></a> Instagram</li>
                    <li><a href="https://twitter.com/modamex" target="_blank"><img src="Imagenes/twitter.png"
                                alt="Twitter"></a> Twitter</li>
                    <li><a href="https://wa.me/525587654321" target="_blank"><img src="Imagenes/whatsapp.png"
                                alt="WhatsApp"></a> WhatsApp</li>
                </ul>
            </div>
        </div>
        <div class="derechos">
            <p><b>&copy; 2024 Modamex. Todos los derechos reservados.</b></p>
        </div>
    </footer>

    <!-- Suggested CSS to be added to carro.css -->
    <style>
        .boton-comprar.desactivado {
            background-color: #cccccc;
            color: #666666;
            cursor: not-allowed;
            pointer-events: none;
        }
    </style>
</body>

</html>