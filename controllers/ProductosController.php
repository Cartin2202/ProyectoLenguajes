<?php
require_once('models/productosModel.php');

class ProductosController {
    public function mostrarProductos() {
        $model = new ProductosModel();
        $categorias = $model->obtenerCategoriasActivas();
        $productos = $model->obtenerProductosFiltrados();
        $filtro_categoria = isset($_GET['categoria']) ? intval($_GET['categoria']) : 0;

        include('views/productos_view.php');
    }
}
