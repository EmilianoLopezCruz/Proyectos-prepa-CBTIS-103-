<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Confirmación de Compra </title>
  <link rel="stylesheet" href="confirmacion.css">
  </head>
<body>
  <!-- insercion de nav usando php -->
  <?php
  include('nav_bar.php');
  ?>

  <main>
    <section class="confirmation">
      <div class="status">
        <div class="icon-success">✔</div>
        <h1>¡Gracias por tu compra!</h1>
        <p>Tu solicitud de compra fue recibida</p>
        <p>Tu pedido se encuentra en proceso de validación. En breve recibirás un correo con el detalle de tu compra.</p>
        <p><strong>Pedido:</strong> <?php
function generarCodigoAleatorio() {
    // Generar primera parte: un número aleatorio entre 0 y 9
    $primeraParte = sprintf("%01d", rand(0, 9));
    
    // Generar letra mayúscula aleatoria
    $letra = chr(rand(65, 90)); // A-Z
    
    // Segunda parte: dos dígitos aleatorios 
    $segundaParte = sprintf("%02d", rand(0, 99));
    
    // Tercera parte: 8 ceros seguidos de un número aleatorio de 1 a 9
    $terceraParte = '0000000' . rand(1, 9);
    
    // Combinar las partes en el formato deseado
    return "{$primeraParte}{$letra}{$segundaParte}-{$terceraParte}";
}

// Generar y mostrar UN código
echo generarCodigoAleatorio();
?></p>
        <p><strong>Fecha de Solicitud de Compra:</strong> <?php
// Establece la zona horaria (puedes cambiarla según tu ubicación)
date_default_timezone_set('America/Mexico_City');

// Obtén la fecha exacta con formato
$fecha = date('Y/m/d H:i:s');

// Muestra la fecha exacta
echo "$fecha";
?></p>
      </div>
      <div class="details">
        <div class="delivery">
        <a href="index.php"><button class="btn-salir">salir</button></a>
        </div>
    </section>
        </main>

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
                <a href="politicas.html">
                    <li><strong> Política de privacidad </strong></li>
                </a>
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
</html>