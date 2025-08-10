<?php
require_once 'models/CategoriasModel.php';

$model = new CategoriasModel();

// Eliminar categoría (lógica: cambia estado a 2)
if (isset($_GET['action']) && $_GET['action'] == 'eliminar' && isset($_GET['id'])) {
    $model->eliminarCategoria($_GET['id']);
    header('Location: categorias.php');
    exit();
}

// Obtener lista de categorías activas
$categorias = $model->obtenerCategorias();

// Cargar la vista
include 'views/categorias_view.php';
