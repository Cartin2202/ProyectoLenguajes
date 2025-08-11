<?php
require_once 'controllers/ProveedoresController.php';
include('views/partials/header.php');
include('views/partials/navbar.php');

$controller = new ProveedoresController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id_proveedor  = $_POST['id_proveedor'];
  $id_producto   = $_POST['id_producto'];
  $precio_compra = $_POST['precio_compra']; 
  $controller->asociarProductoProveedor($id_proveedor, $id_producto, $precio_compra);

  echo "<section class='section-box rounded-4 shadow-sm my-4'><div class='container py-3'>
          <div class='alert alert-success text-center rounded-4 m-0'>
            Producto asociado al proveedor correctamente.
          </div>
        </div></section>";
}

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Asociar Producto a Proveedor</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css?v=6">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<section class="section-box rounded-4 shadow-sm my-4">
  <div class="container py-4">

    <div class="form-card rounded-4 p-3 p-md-4">
      <h2 class="fw-bold mb-4"><i class="bi bi-link-45deg me-2"></i> Asociar Producto a Proveedor</h2>

      <form method="POST" action="proveedores.php?action=asociar">
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label fw-semibold">ID Proveedor</label>
            <input type="number" name="id_proveedor" class="form-control rounded-pill" required>
          </div>
          <div class="col-md-4">
            <label class="form-label fw-semibold">ID Producto</label>
            <input type="number" name="id_producto" class="form-control rounded-pill" required>
          </div>
          <div class="col-md-4">
            <label class="form-label fw-semibold">Precio Compra</label>
            <input type="number" name="precio_compra" step="0.01" class="form-control rounded-pill" required>
          </div>
        </div>

        <div class="mt-3 d-flex gap-2">
          <button type="submit" class="btn btn-outline-accent rounded-pill">
            <i class="bi bi-plus-lg me-1"></i> Asociar Producto
          </button>
          <a href="proveedores.php" class="btn btn-outline-secondary rounded-pill">Cancelar</a>
        </div>
      </form>
    </div>

  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
