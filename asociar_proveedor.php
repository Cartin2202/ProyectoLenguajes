<?php
require_once 'controllers/ProveedoresController.php';
 include('views/partials/header.php'); 
 include('views/partials/navbar.php'); 
$controller = new ProveedoresController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProveedor = $_POST['id_proveedor'];
    $idProducto = $_POST['id_producto'];
    $controller->asociarProductoProveedor($id_proveedor, $id_producto);
    echo "<div class='alert alert-success text-center'>Producto asociado al proveedor correctamente.</div>";
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Asociar Producto a Proveedor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <h2>Asociar Producto a Proveedor</h2>

  <form method="POST" action="asociar_proveedor.php">
    <div class="row mb-3">
      <div class="col">
        <label for="id_proveedor" class="form-label">ID Proveedor</label>
        <input type="number" name="id_proveedor" class="form-control" required>
      </div>
      <div class="col">
        <label for="id_producto" class="form-label">ID Producto</label>
        <input type="number" name="id_producto" class="form-control" required>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Asociar</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
