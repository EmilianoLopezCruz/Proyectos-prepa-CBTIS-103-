<?php
header('Content-Type: application/json');
session_start();
include 'cnn.php'; // Conexión a la base de datos

if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
$id_usuario = $_SESSION['id_usuario'];
$id_vestido = $data['id'];
$action = $data['action'];

try {
    if ($action === 'add') {
        // Insertar en la tabla wishlist  (`id_wishlist`, `id_usuario_w`, `id_articulo_w`) VALUES (NULL, '1', '1')
        $query = $cnn->prepare("INSERT INTO `Wishlist` (`id_wishlist`, `id_usuario_w`, `id_articulo_w`) VALUES (NULL, :id_usuario, :id_vestido)");
        $query->execute([':id_usuario' => $id_usuario, ':id_vestido' => $id_vestido]);
    } elseif ($action === 'remove') {
        // Eliminar de la tabla wishlist
        $query = $cnn->prepare("DELETE FROM `Wishlist` WHERE `id_usuario_w` = :id_usuario AND `id_articulo_w` = :id_vestido");
        $query->execute([':id_usuario' => $id_usuario, ':id_vestido' => $id_vestido]);
    } else {
        throw new Exception('Acción no válida');
    }
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
