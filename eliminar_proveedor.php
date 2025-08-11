<?php
require_once 'controllers/ProveedoresController.php';
include('views/partials/header.php'); 
include('views/partials/navbar.php');

$controller = new ProveedoresController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id_proveedor'];
  $controller->eliminarProveedor($id);
  echo "<section class='section-box rounded-4 shadow-sm my-4'><div class='container py-3'>
          <div class='alert alert-danger text-center rounded-4 m-0'>
            Proveedor eliminado (cambiado a estado inactivo).
          </div>
        </div></section>";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Eliminar Proveedor</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css?v=7">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<section class="section-box rounded-4 shadow-sm my-4">
  <div class="container py-4">

    <div class="form-card rounded-4 p-3 p-md-4">
      <h2 class="fw-bold mb-4">
        <i class="bi bi-building-dash me-2"></i> Eliminar Proveedor
      </h2>

      <form method="POST" action="eliminar_proveedor.php">
        <div class="mb-3">
          <label for="id_proveedor" class="form-label fw-semibold">ID del Proveedor</label>
          <input type="number" class="form-control rounded-pill" id="id_proveedor" name="id_proveedor" required>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-danger rounded-pill">
            <i class="bi bi-trash me-1"></i> Eliminar
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

