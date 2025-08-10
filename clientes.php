<?php
require_once 'controllers/ClientesController.php';

$controller = new ClientesController();

// Ejecutar acciones según el parámetro `action`
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['accion'] ?? '';

    switch ($action) {
        case 'registrar':
            $controller->registrarClientes($_POST);
            break;
        case 'actualizar':
            $controller->actualizarClientes($_POST);
            break;
        case 'eliminar':
            $controller->eliminarClientes($_POST);
            break;
        }

    header('Location: clientes.php');
    exit();

    }
    include 'views/clientes_view.php';

    




