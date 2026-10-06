<?php
session_start();

// Verificar si el carrito tiene productos
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
  header('Location: index.php');
  exit();
}

$productos = $_SESSION['carrito'];
$total = 0;

// Calcular el total de los productos en el carrito
foreach ($productos as $producto) {
  // Verificar si el precio existe
  $precio = isset($producto['precio']) ? $producto['precio'] : 0;
  $precio_total = intval($precio) * intval($producto['cantidad']);
  $total += $precio_total;
}

// Calcular IVA (16%)
$iva = $total * 0.16;
$total_con_iva = $total + $iva;

// Si se confirma la compra, vaciar el carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar_compra'])) {
  unset($_SESSION['carrito']); // Vaciar el carrito
  header('Location: confirmacion.php'); // Redirigir a la página de confirmación
  exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Finalizar Compra</title>
  <link rel="stylesheet" href="tarjeta.css">
  <style>
    .buy-button:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }
  </style>
</head>

<body>
  <!-- Inserción de nav_bar.php -->
  <?php include('nav_bar.php'); ?>

  <main>
    <section class="cart-section">
      <div class="cart-header">
        <h2>Artículos en tu carrito (<?php echo count($productos); ?>)</h2>
        <a href="index.php" class="continue-shopping">← Continuar comprando</a>
      </div>

      <div class="cart-container">
        <!-- Bloques de los artículos -->
        <div class="cart-items">
          <?php foreach ($productos as $producto): ?>
            <div class="cart-item">
              <!-- Mostrar imagen del producto -->
              <img src="Imagenes/<?php echo strtolower(str_replace(" ", "_", $producto['nombre'])) . ".png"; ?>"
                alt="Producto" class="item-image">
              <p class="item-name"><?php echo htmlspecialchars($producto['nombre']); ?></p>
              <p class="item-description">Cantidad: <?php echo htmlspecialchars($producto['cantidad']); ?></p>

              <?php
              // Verificar si el precio existe
              $precio = isset($producto['precio']) ? $producto['precio'] : 0;
              ?>

              <!-- Mostrar precio unitario -->
              <p class="item-price">$<?php echo number_format(floatval($precio), 2); ?></p>

              <!-- Mostrar total por producto -->
              <p class="item-total">Total: $<?php echo number_format(floatval($precio) * floatval($producto['cantidad']), 2); ?></p>

            </div>
          <?php endforeach; ?>
        </div>

        <!-- Resumen del pedido -->
        <div class="summary">
          <p>Subtotal: $<?php echo number_format($total, 2); ?></p>
          <p>Total (IVA 16%): $<?php echo number_format($iva, 2); ?></p>
          <p>Total con IVA: $<?php echo number_format($total_con_iva, 2); ?></p>
          <form action="tarjeta.php" method="POST">
            <button class="buy-button" name="confirmar_compra" disabled>Confirmar Compra</button>
          </form>
        </div>
      </div>
    </section>

    <section class="form-section">
      <div class="form-group">
        <h3>Dirección</h3>
        <form action="procesar_compra.php" method="POST" id="direccionForm">
          <input type="text" name="direccion" id="direccion" placeholder="Dirección" required class="form-input">
          <input type="text" name="estado" id="estado" placeholder="Estado" required class="form-input">
          <input type="text" name="codigo_postal" id="codigo_postal" placeholder="Código Postal" pattern="\d{5}"
            title="Código postal de 5 dígitos" required class="form-input">
          <input type="tel" name="telefono" id="telefono" placeholder="Teléfono" required class="form-input">
        </form>
      </div>

      <div class="form-group">
        <h3>Detalles de la tarjeta</h3>
        <form action="procesar_compra.php" method="POST" id="tarjetaForm">
          <input type="text" name="titular" id="titular" placeholder="Titular" required class="form-input">
          <input type="text" name="numero_tarjeta" id="numero_tarjeta" placeholder="Número de tarjeta" maxlength="19"
            pattern="\d{4} \d{4} \d{4} \d{4}" title="Número de tarjeta válido de 16 dígitos" required
            class="form-input">
          <input type="text" name="expiracion" id="expiracion" placeholder="Exp. MM/YY" maxlength="5"
            pattern="(0[1-9]|1[0-2])\/\d{2}" title="Formato válido: MM/YY" required class="form-input">
          <input type="text" name="cvv" id="cvv" placeholder="CVV" maxlength="3" pattern="\d{3}"
            title="CVV de 3 dígitos" required class="form-input">
        </form>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <div class="contenedorFooter">
      <!-- Información general -->
      <div class="infoModamex">
        <img src="Imagenes/logoColibri.png" alt="Modamex Logo" class="logoColibri">
        <p>En <strong>Modamex</strong>, nos dedicamos a ofrecerte los mejores vestidos para cualquier ocasión. Calidad,
          estilo y diseño en un solo lugar.</p>
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
          <li><a href="https://twitter.com/modamex" target="_blank"><img src="Imagenes/twitter.png" alt="Twitter"></a>
            Twitter</li>
          <li><a href="https://wa.me/525587654321" target="_blank"><img src="Imagenes/whatsapp.png" alt="WhatsApp"></a>
            WhatsApp</li>
        </ul>
      </div>
    </div>
    <div class="derechos">
      <p><b>&copy; 2024 Modamex. Todos los derechos reservados.</b></p>
    </div>
  </footer>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Get all form inputs
      const direccionInput = document.getElementById("direccion");
      const estadoInput = document.getElementById("estado");
      const codigoPostalInput = document.getElementById("codigo_postal");
      const telefonoInput = document.getElementById("telefono");
      const titularInput = document.getElementById("titular");
      const numeroTarjetaInput = document.getElementById("numero_tarjeta");
      const expiracionInput = document.getElementById("expiracion");
      const cvvInput = document.getElementById("cvv");
      const confirmarCompraButton = document.querySelector('.buy-button');

      // Function to validate all inputs
      function validateInputs() {
        const requiredInputs = [
          direccionInput, estadoInput, codigoPostalInput, telefonoInput, 
          titularInput, numeroTarjetaInput, expiracionInput, cvvInput
        ];

        const allFilled = requiredInputs.every(input => input.value.trim() !== '');
        
        // Disable/enable button based on input validity
        confirmarCompraButton.disabled = !allFilled;
        confirmarCompraButton.style.opacity = allFilled ? '1' : '0.5';
        confirmarCompraButton.style.cursor = allFilled ? 'pointer' : 'not-allowed';
      }

      // Format expiration input
      expiracionInput.addEventListener('input', function(e) {
        // Remove non-numeric characters
        let input = this.value.replace(/\D/g, '');
        
        // Limit to 4 digits
        input = input.slice(0, 4);
        
        // Format as MM/YY
        if (input.length >= 2) {
          input = input.slice(0, 2) + '/' + input.slice(2);
        }
        
        this.value = input;
      });

      // Add input event listeners to validate inputs
      const inputsToValidate = [
        direccionInput, estadoInput, codigoPostalInput, telefonoInput, 
        titularInput, numeroTarjetaInput, expiracionInput, cvvInput
      ];

      inputsToValidate.forEach(input => {
        input.addEventListener('input', validateInputs);
      });

      // Initial validation
      validateInputs();

      // Prevent form submission if inputs are invalid
      const forms = document.querySelectorAll('form[action="procesar_compra.php"]');
      forms.forEach(form => {
        form.addEventListener('submit', function(e) {
          const requiredInputs = [
            direccionInput, estadoInput, codigoPostalInput, telefonoInput, 
            titularInput, numeroTarjetaInput, expiracionInput, cvvInput
          ];

          const allFilled = requiredInputs.every(input => input.value.trim() !== '');
          
          if (!allFilled) {
            e.preventDefault();
            alert("Por favor, complete todos los campos.");
          }
        });
      });
    });
  </script>
</body>

</html>