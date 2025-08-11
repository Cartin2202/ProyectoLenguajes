<?php
require_once(__DIR__ . '/controllers/InventarioController.php');
include('views/partials/header.php');
include('views/partials/navbar.php');

$controller = new InventarioController();
$tipos   = $controller->obtenerTiposMovimiento();
$motivos = $controller->obtenerMotivos();
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<section class="section-box rounded-4 shadow-sm my-4">
  <div class="container py-4">

    <div class="form-card rounded-4 p-3 p-md-4">
      <h4 class="fw-bold mb-3">
        <i class="bi bi-plus-circle me-2"></i> Registrar Movimiento de Inventario
      </h4>

      <form method="POST" action="inventario.php?action=insertar">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label fw-semibold">Tipo Movimiento</label>
            <select name="tipo" class="form-select rounded-pill" required>
              <option value="">Seleccione tipo de movimiento</option>
              <?php foreach ($tipos as $t): ?>
                <option value="<?= $t['ID_TIPO_MOVIMIENTO'] ?>"><?= htmlspecialchars($t['TIPO']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">Motivo</label>
            <select name="motivo" class="form-select rounded-pill" required>
              <option value="">Seleccione un motivo</option>
              <?php foreach ($motivos as $m): ?>
                <option value="<?= $m['ID_MOTIVO'] ?>"><?= htmlspecialchars($m['MOTIVO']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="mt-3">
          <button type="submit" class="btn btn-accent rounded-pill">
            <i class="bi bi-check2-circle me-1"></i> Registrar Movimiento
          </button>
        </div>
      </form>
    </div>

  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


