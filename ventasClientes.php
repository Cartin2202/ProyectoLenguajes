<?php
require_once 'controllers/ClientesController.php';

$controller = new ClientesController();
$cedula = $_GET['cedula'] ?? null;
$ventas  = $controller->obtenerVentasPorCliente($cedula);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Ventas del Cliente <?= htmlspecialchars($cedula ?? '') ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css?v=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
  <?php include('views/partials/header.php'); ?>
  <?php include('views/partials/navbar.php'); ?>

  <section class="section-box rounded-4 shadow-sm my-4">
    <div class="container py-4">

      <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
        <h2 class="m-0 fw-bold">Ventas del Cliente: <?= htmlspecialchars($cedula ?? '') ?></h2>
        <a href="clientes.php" class="btn btn-outline-secondary rounded-pill">
          <i class="bi bi-arrow-left"></i> Volver
        </a>
      </div>

      <?php if (!empty($ventas)): ?>
        <div class="table-responsive rounded-4 overflow-hidden shadow-sm">
          <table class="table table-elegant align-middle mb-0">
            <thead>
              <tr class="text-center">
                <th style="width:160px;">Fecha</th>
                <th>Producto</th>
                <th style="width:100px;">Cantidad</th>
                <th style="width:160px;">Precio Unitario</th>
                <th style="width:160px;">Total Venta</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($ventas as $venta): ?>
                <?php
                  $cant = (int)($venta['CANTIDAD'] ?? 0);
                  $unit = (float)($venta['PRECIO_UNITARIO'] ?? 0);
                  $sub  = isset($venta['SUBTOTAL']) ? (float)$venta['SUBTOTAL'] : ($cant * $unit);
                ?>
                <tr>
                  <td class="text-center"><?= htmlspecialchars($venta['FECHA'] ?? '') ?></td>
                  <td><?= htmlspecialchars($venta['NOMBRE'] ?? '') ?></td>
                  <td class="text-center"><?= $cant ?></td>
                  <td class="text-center">₡<?= number_format($unit, 2, ',', '.') ?></td>
                  <td class="text-center">₡<?= number_format($sub, 2, ',', '.') ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <div class="alert alert-info rounded-4">No hay ventas registradas para este cliente.</div>
      <?php endif; ?>

    </div>
  </section>

  <?php include 'views/partials/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

