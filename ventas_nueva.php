<?php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../controllers/VentasController.php';

$vc = new VentasController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $cedula = (int)($_POST['cedula'] ?? 0);
  if ($cedula) {
    $idVenta = $vc->crearVenta($cedula);
    header("Location: ventas_editar.php?id=" . urlencode($idVenta));
    exit;
  }
}

$clientes = $vc->listarClientes();


?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Nueva venta</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css?v=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<section class="section-box rounded-4 shadow-sm my-4">
  <div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="m-0 fw-bold"><i class="bi bi-receipt me-2"></i> Nueva venta</h2>
      <a href="ventas_listado.php" class="btn btn-outline-secondary rounded-pill">
        <i class="bi bi-arrow-left"></i> Volver
      </a>
    </div>

    <div class="form-card rounded-4 p-3 p-md-4">
      <form method="post" class="row g-3 align-items-end">
        <div class="col-md-8">
          <label class="form-label fw-semibold">Cliente</label>
          <select name="cedula" class="form-select rounded-pill" required>
            <option value="">-- Seleccione --</option>
            <?php foreach ($clientes as $c): ?>
              <option value="<?= htmlspecialchars($c['CEDULA']) ?>">
                <?= htmlspecialchars(trim(($c['NOMBRE'] ?? '').' '.($c['PRIMER_APELLIDO'] ?? '').' '.($c['SEGUNDO_APELLIDO'] ?? ''))) ?>
                <?= isset($c['CORREO']) && $c['CORREO'] !== '' ? ' ('.htmlspecialchars($c['CORREO']).')' : '' ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-4 text-md-end">
          <button type="submit" class="btn btn-accent rounded-pill w-100">
            <i class="bi bi-plus-circle me-1"></i> Crear venta
          </button>
        </div>
      </form>
    </div>

  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
