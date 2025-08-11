<?php
include 'views/partials/header.php'; 

require_once('controllers/InventarioController.php');
$controller = new InventarioController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'] ?? '';
    switch ($action) {
        case 'insertar':
            $controller->insertarMovimiento($_POST['tipo'], $_POST['motivo']);
            break;
        case 'asociar':
            $controller->asociarProducto($_POST['id_movimiento'], $_POST['id_producto'], $_POST['cantidad']);
            break;
        case 'actualizar':
            $controller->actualizarMovimiento($_POST['id_movimiento'], $_POST['tipo'], $_POST['motivo']);
            break;
        case 'eliminar':
            $controller->eliminarMovimiento($_POST['id_movimiento']);
            break;
    }
    header('Location: inventario.php');
    exit();
}
?>


<?php include 'lista_movimientos.php'; ?>

