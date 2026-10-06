<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Inicio Modamex </title>
    <link rel="stylesheet" href="inicio.css">
    <script>
        // Lista de todas las imágenes disponibles
        const imagenes = [
            "vestidos_noche_eq2/vn1.png", "vestidos_noche_eq2/vn2.png", "vestidos_noche_eq2/vn3.png",
            "vestidos_noche_eq2/vn2.png", "vestidos_noche_eq2/vn3.png", "vestidos_noche_eq2/vn4.png",
            "vestidos_noche_eq2/vn3.png", "vestidos_noche_eq2/vn4.png", "vestidos_noche_eq2/vn5.png",
            "vestidos_noche_eq2/vn4.png", "vestidos_noche_eq2/vn5.png", "vestidos_noche_eq2/vn1.png",
            "vestidos_noche_eq2/vn5.png", "vestidos_noche_eq2/vn1.png", "vestidos_noche_eq2/vn2.png"

        ];

        let indiceActual = 0; // Índice de las imágenes que se están mostrando

        function cambiarImagenes(direccion) {
            // Calcular nuevo índice basado en la dirección
            const cantidadPorPagina = 3; // Número de imágenes a mostrar por vez
            const totalPaginas = Math.ceil(imagenes.length / cantidadPorPagina);

            indiceActual += direccion;

            // Hacer que el carrusel sea cíclico
            if (indiceActual < 0) {
                indiceActual = totalPaginas - 1;
            } else if (indiceActual >= totalPaginas) {
                indiceActual = 0;
            }

            // Mostrar las imágenes correspondientes
            const contenedor = document.querySelector(".contenedor-imagenes");
            contenedor.innerHTML = ""; // Limpiar imágenes actuales

            // Insertar las nuevas imágenes
            const inicio = indiceActual * cantidadPorPagina;
            const fin = inicio + cantidadPorPagina;
            const nuevasImagenes = imagenes.slice(inicio, fin);

            nuevasImagenes.forEach((imagenSrc) => {
                const img = document.createElement("img");
                img.src = imagenSrc;
                img.alt = "Imagen";
                contenedor.appendChild(img);
            });
        }
        cambiarImagenes(0); // Mostrar las primeras imágenes al cargar la página
    </script>

</head>

<body>
    <!-- insercion de nav usando php -->
    <?php
    include('nav_bar_index.php');
    ?>

    <br><br><br>
    <div class="contenedorCarrusel">
        <div class="textoCarrusel">
            <p> ¡Bienvenido a Modamex!
                🌟 ¡Tu estilo, nuestra inspiración! 🛒 Explora las mejores tendencias de moda en Modamex. ¡Compra hoy! 🕶️👗
                🎁 ¡Sorpréndete! Modamex tiene todo lo que necesitas para brillar esta temporada 🌟 ¡Compra ahora!
                🚀 Descubre productos únicos al mejor precio 🔥 ¡Compra ahora y sé parte de la experiencia Modamex! 💼✨ </p>
        </div>
    </div> <br>

    <section class="Primer_Section">
        <div class="filtro_Imagen">
            <div class="contenido">
                <p class="bienvenida">Bienvenid@ a:</p>
                <p class="titulo"> Modamex</p>
                <p class="descripcion"> donde la moda esta diseñada con código </p>
            </div>
        </div>
    </section>

    <br>
    <section class="Tercer_Section">
        <label class="tittle3"> Categoría </label>
        <div class="contenedorImagenes2">
            <div class="contenedorVestido">
                <a href="Diseños.php?cat=1">
                    <img class="circulo" src="vestidos_boda_eq2/vb5.png" alt="Imagen 1">
                </a>
                <p class="textocategoria"> Boda </p>
            </div>
            <div class="contenedorVestido">
                <a href="Diseños.php?cat=2">
                    <img class="circulo" src="vestidos_xv_eq2/vXV3.png" alt="Imagen 2">
                </a>
                <p class="textocategoria"> XV </p>
            </div>
            <div class="contenedorVestido">
                <a href="Diseños.php?cat=4">
                    <img class="circulo" src="vestidos_noche_eq2/vn10.png" alt="Imagen 3">
                </a>
                <p class="textocategoria"> De noche </p>
            </div>
            <div class="contenedorVestido">
                <a href="Diseños.php?cat=3">
                    <img class="circulo" src="vestidos coctel/vestido 7/vc7.jpg" alt="Imagen 3">
                </a>
                <p class="textocategoria"> De coctel</p>
            </div>
        </div>
    </section>

    <br> <br>
    <section class="Segundo_Section">
        <div class="filtro_Imagen2">
            <div class="contenido">
                <p class="tittle2"> Diseños </p>
                <div class="botones">
                    <a href="Diseños.php">
                        <button class="boton"> Ver más </button>
                    </a>
                </div>
            </div>
        </div>
    </section> <br>

    <div class="no_se_como_llamarlo">
        <label class="texto"> Descubre lo nuevo en Modamex </label><br>
        <label class="tittle"> Nueva Colección de 'Noche'</label><br> <br>
        <div class="jijijija">
            <input type="button" value="<" onclick="cambiarImagenes(-1)">
            <a href="Diseños.php?cat=4">
                <div class="contenedor-imagenes">
                    <img src="vestidos_noche_eq2/vn1.png" alt="Imagen 1">
                    <img src="vestidos_noche_eq2/vn2.png" alt="Imagen 2">
                    <img src="vestidos_noche_eq2/vn3.png" alt="Imagen 3">
                </div>
            </a>
            <input type="button" value=">" onclick="cambiarImagenes(1)">
        </div>
    </div> <br> <br>
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
                    <li><a href="Diseño.php?cat=3"> Cóctel </a></li>
                    <li><a href="Diseño.php?cat=2"> XV años </a></li>
                    <li><a href="Diseño.php?cat=1"> Boda </a></li>
                    <li><a href="Diseño.php?cat=4"> Noche </a></li>
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