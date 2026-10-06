<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProducto = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $imagen = $_POST['imagen'];

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    if (isset($_SESSION['carrito'][$idProducto])) {
        $_SESSION['carrito'][$idProducto]['cantidad'] += $cantidad;
    } else {
        $_SESSION['carrito'][$idProducto] = [
            'nombre' => $nombre,
            'precio' => $precio,
            'cantidad' => $cantidad,
            'imagen' => $imagen,
        ];
    }
}

header('Location: carro.php');
exit();
?>
