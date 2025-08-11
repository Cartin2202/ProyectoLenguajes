<?php
require_once(__DIR__ . '/../controllers/InventarioController.php');
$controller = new InventarioController();
?>

<section class="section-box rounded-4 shadow-sm my-4">
  <div class="container py-4">

    <h2 class="fw-bold mb-4">Módulo de Inventario</h2>

    <div class="form-card rounded-4 p-3 p-md-4 mb-4">
      <h5 class="fw-bold mb-3"><i class="bi bi-plus-circle me-2"></i>Registrar Movimiento</h5>
      <form method="POST" action="inventario.php?action=insertar">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label fw-semibold">Tipo Movimiento</label>
            <select name="tipo" class="form-select rounded-pill" required>
              <option value="">Seleccione tipo de movimiento</option>
              <?php
              $tipos = $controller->obtenerTiposMovimiento();
              foreach ($tipos as $t) {
                  echo "<option value='{$t['ID_TIPO_MOVIMIENTO']}'>{$t['TIPO']}</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-semibold">Motivo</label>
            <select name="motivo" class="form-select rounded-pill" required>
              <option value="">Seleccione un motivo</option>
              <?php
              $motivos = $controller->obtenerMotivos();
              foreach ($motivos as $m) {
                  echo "<option value='{$m['ID_MOTIVO']}'>{$m['MOTIVO']}</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class="mt-3">
          <button type="submit" class="btn btn-accent rounded-pill">
            <i class="bi bi-check2-circle"></i> Registrar
          </button>
        </div>
      </form>
    </div>

    <div class="form-card rounded-4 p-3 p-md-4 mb-4">
      <h5 class="fw-bold mb-3"><i class="bi bi-link-45deg me-2"></i>Asociar Producto a Movimiento</h5>
      <form method="POST" action="inventario.php?action=asociar">
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label fw-semibold">ID Movimiento</label>
            <input type="number" name="id_movimiento" class="form-control rounded-pill" required>
          </div>
          <div class="col-md-4">
            <label class="form-label fw-semibold">ID Producto</label>
            <input type="number" name="id_producto" class="form-control rounded-pill" required>
          </div>
          <div class="col-md-4">
            <label class="form-label fw-semibold">Cantidad</label>
            <input type="number" name="cantidad" class="form-control rounded-pill" required>
          </div>
        </div>
        <div class="mt-3">
          <button type="submit" class="btn btn-outline-accent rounded-pill">
            <i class="bi bi-plus"></i> Asociar
          </button>
        </div>
      </form>
    </div>

    <div class="form-card rounded-4 p-3 p-md-4 mb-4">
      <h5 class="fw-bold mb-3"><i class="bi bi-arrow-repeat me-2"></i>Actualizar Movimiento</h5>
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
              <?php
              foreach ($tipos as $t) {
                  echo "<option value='{$t['ID_TIPO_MOVIMIENTO']}'>{$t['TIPO']}</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label fw-semibold">Nuevo Motivo</label>
            <select name="motivo" class="form-select rounded-pill" required>
              <option value="">Seleccione motivo</option>
              <?php
              foreach ($motivos as $m) {
                  echo "<option value='{$m['ID_MOTIVO']}'>{$m['MOTIVO']}</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class="mt-3">
          <button type="submit" class="btn btn-warning rounded-pill">
            <i class="bi bi-save2"></i> Actualizar
          </button>
        </div>
      </form>
    </div>

    <div class="form-card rounded-4 p-3 p-md-4 mb-4">
      <h5 class="fw-bold mb-3"><i class="bi bi-trash me-2"></i>Eliminar Movimiento</h5>
      <form method="POST" action="inventario.php?action=eliminar">
        <div class="row g-3 align-items-end">
          <div class="col-md-4">
            <label class="form-label fw-semibold">ID Movimiento</label>
            <input type="number" name="id_movimiento" class="form-control rounded-pill" required>
          </div>
          <div class="col-md-4">
            <button type="submit" class="btn btn-danger rounded-pill">
              <i class="bi bi-trash"></i> Eliminar
            </button>
          </div>
        </div>
      </form>
    </div>

    <div class="rounded-4 overflow-hidden shadow-sm">
      <table class="table table-elegant align-middle mb-0">
        <thead>
          <tr>
            <th style="width:100px">ID</th>
            <th>Tipo</th>
            <th>Motivo</th>
            <th>Fecha</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $movimientos = $controller->listarMovimientos();
          if (!empty($movimientos)):
            foreach ($movimientos as $mov): ?>
              <tr>
                <td class="fw-semibold"><?= htmlspecialchars($mov['ID_MOVIMIENTO'] ?? '') ?></td>
                <td><?= htmlspecialchars($mov['TIPO_MOVIMIENTO'] ?? '') ?></td>
                <td><?= htmlspecialchars($mov['MOTIVO'] ?? '') ?></td>
                <td><?= htmlspecialchars($mov['FECHA'] ?? '') ?></td>
              </tr>
            <?php endforeach;
          else: ?>
            <tr><td colspan="4" class="text-center">No hay movimientos registrados.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

  </div>
</section>


