<?php
require_once 'controllers/VentasController.php';

$controller = new VentasController();

if (isset($_GET['action']) && $_GET['action']==='factura' && isset($_GET['id'])) {
    try {
        $path = $controller->generarFacturaTxt((int)$_GET['id']);
        header("Location: $path");
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

$ventas = $controller->listarVentas();
$ventaId = isset($_GET['ver']) ? (int)$_GET['ver'] : null;
$detalle = $ventaId ? $controller->listarDetalleVenta($ventaId) : [];
$ventaSel = $ventaId ? $controller->obtenerVenta($ventaId) : null;

include 'views/partials/header.php';
include 'views/partials/navbar.php';
include 'views/ventas_view.php';
