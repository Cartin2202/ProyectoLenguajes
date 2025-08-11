<?php
require_once 'controllers/ProveedoresController.php';

$controller = new ProveedoresController();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'registrar':
            $controller->registrarProveedor($_POST['empresa'], $_POST['correo']);
            break;

        case 'asociar':
            $controller->asociarProductoProveedor($_POST['id_proveedor'], $_POST['id_producto'], $_POST['precio_compra']);
            break;

        case 'actualizar':
            $controller->actualizarProveedor($_POST['id_proveedor'], $_POST['empresa'], $_POST['correo']);
            break;

        case 'eliminar':
            $controller->eliminarProveedor($_POST['id_proveedor']);
            break;
    }

    header('Location: proveedores.php');
    exit();

    
}

$proveedores = $controller->listarProveedores();

include 'views/proveedores_view.php';


