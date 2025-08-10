<?php 
include('views/partials/header.php');
include('views/partials/navbar.php');
?> 

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<section class="section-box rounded-4 shadow-sm my-4">
  <div class="container py-4">
    <div class="form-card rounded-4 p-3 p-md-4">
      <h4 class="fw-bold mb-3">
        <i class="bi bi-arrow-repeat me-2"></i> Actualizar Movimiento de Inventario
      </h4>

      <form method="POST" action="inventario.php?action=actualizar">
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label fw-semibold">ID Movimiento</label>
            <input type="number" name="id_movimiento" class="form-control rounded-pill" required>
          </div>

          <div class="col-md-4">
            <label class="form-label fw-semibold">Nuevo Tipo</label>
            <select name="tipo" class="form-select rounded-pill" required>
              <option value="">Seleccione tipo</option>
              <?php foreach ($tipos as $t): ?>
                <option value="<?= $t['ID_TIPO_MOVIMIENTO'] ?>"><?= htmlspecialchars($t['TIPO']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-md-4">
            <label class="form-label fw-semibold">Nuevo Motivo</label>
            <select name="motivo" class="form-select rounded-pill" required>
              <option value="">Seleccione motivo</option>
              <?php foreach ($motivos as $m): ?>
                <option value="<?= $m['ID_MOTIVO'] ?>"><?= htmlspecialchars($m['MOTIVO']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="mt-3">
          <button type="submit" class="btn btn-warning rounded-pill">
            <i class="bi bi-save2 me-1"></i> Actualizar Movimiento
          </button>
        </div>
      </form>
    </div>
  </div>
</section>

<!-- Si no lo tienes ya en header.php, carga Bootstrap JS una sola vez -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

