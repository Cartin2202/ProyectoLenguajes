<?php
require_once 'controllers/InventarioController.php';
$controller  = new InventarioController();
$movimientos = $controller->listarMovimientos();

include('views/partials/header.php');
include('views/partials/navbar.php');
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<section class="section-box rounded-4 shadow-sm my-4">
  <div class="container py-4">

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
      <h2 class="m-0 fw-bold">Lista de Movimientos de Inventario</h2>
      <!-- Acción opcional (exportar / ir al módulo) -->
      <div class="d-flex gap-2">
        <a href="inventario.php" class="btn btn-outline-accent rounded-pill">
          <i class="bi bi-gear"></i> Ir al módulo
        </a>
      </div>
    </div>

    <div class="table-responsive rounded-4 overflow-hidden shadow-sm">
      <table class="table table-elegant align-middle mb-0">
        <thead>
          <tr class="text-center">
            <th style="width:120px">ID</th>
            <th>Tipo</th>
            <th>Motivo</th>
            <th style="width:180px">Fecha</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <?php if (!empty($movimientos)): ?>
            <?php foreach ($movimientos as $mov): ?>
              <tr>
                <td class="fw-semibold"><?= htmlspecialchars($mov['ID_MOVIMIENTO'] ?? '') ?></td>
                <td><?= htmlspecialchars($mov['TIPO_MOVIMIENTO'] ?? '') ?></td>
                <td><?= htmlspecialchars($mov['MOTIVO'] ?? '') ?></td>
                <td><?= htmlspecialchars($mov['FECHA'] ?? '') ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" class="text-center py-4">No hay movimientos registrados.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

  </div>
</section>

<!-- Carga Bootstrap JS solo si no lo incluyes ya en header.php -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
