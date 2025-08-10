<?php
require_once 'controllers/ProveedoresController.php';

$controller = new ProveedoresController();

// Ejecutar acciones según el parámetro `action`
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

    // Redireccionar luego de realizar acción para evitar reenvío de formularios
    header('Location: proveedores.php');
    exit();

    
}

// Obtener lista de proveedores para la vista
$proveedores = $controller->listarProveedores();

// Cargar vista
include 'views/proveedores_view.php';


