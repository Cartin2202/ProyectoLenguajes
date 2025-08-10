<?php
require_once 'controllers/CarritoController.php';

$controller = new CarritoController();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'] ?? '';
    try {
        switch ($action) {
            case 'add':
                $controller->agregar((int)$_POST['id'], $_POST['nombre'], (float)$_POST['precio'], (int)$_POST['cantidad']);
                break;
            case 'update':
                $controller->actualizar($_POST['cant'] ?? []);
                break;
            case 'checkout':
                try {
                    $ctrl = new CarritoController();
                    $ctrl->checkout($_POST['cliente_id'], $_POST['metodo_pago']);
                    header('Location: carrito.php'); // vuelve al carrito
                    exit;
                } catch (Throwable $e) {
                    if (session_status() === PHP_SESSION_NONE) session_start();
                    $_SESSION['flash_error'] = $e->getMessage();
                    header('Location: carrito.php');
                    exit;
                }
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
    header('Location: carrito.php');
    exit;
}

if (isset($_GET['action'])) {
    if ($_GET['action'] === 'remove' && isset($_GET['id'])) {
        $controller->eliminar((int)$_GET['id']);
    } elseif ($_GET['action'] === 'clear') {
        $controller->vaciar();
    }
    header('Location: carrito.php');
    exit;
}

$datos = $controller->obtenerDatosVista(); // carrito, total, clientes, metodos
include 'views/partials/header.php';
include 'views/partials/navbar.php';
include 'views/carrito_view.php';
