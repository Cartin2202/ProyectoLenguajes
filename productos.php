<?php
require_once 'models/ProductosModel.php';

$model = new ProductosModel();

if (isset($_GET['action']) && $_GET['action'] == 'eliminar' && isset($_GET['id'])) {
    $model->eliminarProducto($_GET['id']);
    header("Location: productos.php");
    exit();
}

$id_categoria = $_GET['categoria'] ?? null;
$productos = $model->obtenerProductos($id_categoria);
$categorias = $model->obtenerCategorias();
$materiales = $model->obtenerMateriales();   // ← AGREGAR
$pesos = $model->obtenerPesos();             // ← AGREGAR

include 'views/productos_view.php';
