<header>
<nav class="nav_bar">
            <a href="index.php" class="contenedorLogo">
                <img src="Imagenes/Modamex_sin_fondo.png" alt="Logo" class="logo">
            </a>
            
            <div class="iconosDerecha">
                <a href="wishlist.php"><img class="icono" src="eq2_iconos/corazon.png" alt="Favoritos"></a>
                <a href="usuario.php"><img class="icono" src="eq2_iconos/usuario.png" alt="Usuario"></a>
                <a href="carro.php"><img class="icono" src="eq2_iconos/bolsa_compra.png" alt="Carrito"></a>
            </div>
        </nav>     
        
</header>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="styles_filt.css">

<aside id="filtersAside">
        <div id="filter_content">
            <h2>Filtros</h2>
            <form id="filters_form" method="GET">
                <label for="categoria">Categoría:</label>
                <select id="categoria" name="categoria">
                    <option value="">Todas</option>
                    <option value="boda">Bodas</option>
                    <option value="xv años">XV años</option>
                    <option value="coctel">Coctel</option>
                    <option value="noche">Noche</option>
                </select>

                <label for="color">Color:</label>
                <select id="color" name="color">
                    <option value="">Todos</option>
                    <option value="rojo">Rojo</option>
                    <option value="verde">Verde</option>                    
                    <option value="azul">Azul</option>
                    <option value="rojo">Negro</option>
                    <option value="blanco">Blanco</option>
                </select>

                <label for="disenador">Diseñador:</label>
                <select id="disenador" name="disenador">
                    <option value="">Todos</option>
                    <option value="Humberto Lara">Humberto Lara</option>
                    <option value="Cindy Guzman">Cindy Guzman</option>
                    <option value="Victoria N.">Victoria N.</option>
                    <option value="Daniel Garcia">Daniel Garcia</option>
                </select>                

                <label for="precio_min">Precio mínimo:</label>
                <input type="number" id="precio_min" name="precio_min" placeholder="Min" />

                <label for="precio_max">Precio máximo:</label>
                <input type="number" id="precio_max" name="precio_max" placeholder="Max" />

                <button type="button" id="applyFiltersBtn">Aplicar Filtros</button>
            </form>
        </div>
    </aside>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="styles_filt.css">

<aside id="filtersAside">
        <div id="filter_content">
            <h2>Filtros</h2>
            <form id="filters_form" method="GET">
                <label for="categoria">Categoría:</label>
                <select id="categoria" name="categoria">
                    <option value="">Todas</option>
                    <option value="boda">Bodas</option>
                    <option value="xv años">XV años</option>
                    <option value="coctel">Coctel</option>
                    <option value="noche">Noche</option>
                </select>

                <label for="color">Color:</label>
                <select id="color" name="color">
                    <option value="">Todos</option>
                    <option value="rojo">Rojo</option>
                    <option value="verde">Verde</option>                    
                    <option value="azul">Azul</option>
                    <option value="negro">Negro</option>
                    <option value="blanco">Blanco</option>
                    <option value="rosa">Rosa</option>
                    <option value="morado">Morado</option>
                </select>

                <label for="disenador">Diseñador:</label>
                <select id="disenador" name="disenador">
                <option value="">Todos</option>
                    <option value="Dafne S.">Dafne S.</option>
                    <option value="Elizabeth L.">Elizabeth L.</option>
                    <option value="Victoria M.">Victoria M.</option>
                </select>                

                <label for="precio_min">Precio mínimo:</label>
                <input type="number" id="precio_min" name="precio_min" placeholder="Min" />

                <label for="precio_max">Precio máximo:</label>
                <input type="number" id="precio_max" name="precio_max" placeholder="Max" />

                <button type="button" id="applyFiltersBtn">Aplicar Filtros</button>
            </form>
        </div>
    </aside>

    <!-- Contenedor de productos -->
    <div id="productsContainer">
        <!-- Los productos se cargarán aquí dinámicamente -->
    </div>

    <script src="scripts.js"></script>
 

