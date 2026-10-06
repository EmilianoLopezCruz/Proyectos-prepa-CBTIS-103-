<?php
// Iniciar sesión
session_start();

// Conexión a la base de datos
$host = 'localhost';
$dbname = 'u481415426_ModaMexDos.';
$username = 'u481415426_admin';
$password = '#Unaclavetodalargota1';
$conn = new mysqli($host, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error al conectar con la base de datos: " . $conn->connect_error);
}

// Obtener los filtros y hacerlos seguros
$categoria = mysqli_real_escape_string($conn, $_GET['categoria'] ?? '');
$color = mysqli_real_escape_string($conn, $_GET['color'] ?? '');
$disenador = mysqli_real_escape_string($conn, $_GET['disenador'] ?? '');
$precio_min = (float) ($_GET['precio_min'] ?? 0);
$precio_max = (float) ($_GET['precio_max'] ?? 1000000);

// Construir la consulta SQL
$sql = "SELECT v.id_vestido AS ID, v.nom_vestido AS 'Nombre', c.nom_categoria AS 'Categoria', col.nom_color AS 'Color', dsg.nom_diseñador AS 'Diseñador', v.precio_vestido AS 'Precio', v.img_vestido AS 'RutaImg'
FROM Vestidos AS v
JOIN Categoria AS c ON v.id_cat_vestido = c.id_categoria
JOIN Colores AS col ON v.id_color_vestido = col.id_color
JOIN Diseñadores AS dsg ON v.id_dsg_vestido = dsg.id_diseñador
WHERE 1 = 1";

// Agregar filtros a la consulta
if ($categoria) $sql .= " AND c.nom_categoria = '$categoria'";
if ($color) $sql .= " AND col.nom_color = '$color'";
if ($disenador) $sql .= " AND d.nom_diseñador = '$disenador'";
if ($precio_min > 0) $sql .= " AND v.precio_vestido >= $precio_min";
if ($precio_max > 0) $sql .= " AND v.precio_vestido <= $precio_max";

// Ejecutar la consulta
$result = $conn->query($sql);

// Guardar los resultados en la sesión
$_SESSION['productos_filtrados'] = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $_SESSION['productos_filtrados'][] = $row;
    }
}

// Cerrar conexión
$conn->close();

// Redirigir a la página de resultados
echo '<a href="resultados.php" id="redirigir">Clic aquí si no redirige automáticamente</a>';
echo '<script>document.getElementById("redirigir").click();</script>';
exit();



