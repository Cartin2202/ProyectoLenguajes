<?php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../controllers/VentasController.php';

$vc = new VentasController();
$idVenta = (int)($_GET['id'] ?? 0);
$venta = $vc->obtenerVenta($idVenta);
if (!$venta) { http_response_code(404); exit('Venta no encontrada'); }

$metodos = $vc->listarMetodosPago();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idMetodo = (int)($_POST['id_metodo_pago'] ?? 0);
  if ($idMetodo) {
    $idFactura = $vc->cerrarVenta($idVenta, $idMetodo, $venta['ID_CLIENTE']);
    header("Location: ventas_factura.php?id_factura=" . urlencode($idFactura) . "&venta=" . urlencode($idVenta));
    exit;
  }
}

// (Opcional) incluye tus parciales si quieres navbar/header global
// include('views/partials/header.php');
// include('views/partials/navbar.php');
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Cerrar venta #<?= htmlspecialchars($idVenta) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Tu CSS -->
  <link rel="stylesheet" href="assets/css/styles.css?v=1">
  <!-- (Opcional) Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<section class="section-box rounded-4 shadow-sm my-4">
  <div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="m-0 fw-bold">Cerrar venta #<?= htmlspecialchars($idVenta) ?></h2>
      <a href="ventas_editar.php?id=<?= urlencode($idVenta) ?>" class="btn btn-outline-secondary rounded-pill">
        <i class="bi bi-arrow-left"></i> Volver
      </a>
    </div>

    <!-- Resumen -->
    <div class="form-card rounded-4 p-3 p-md-4 mb-4">
      <div class="row g-3">
        <div class="col-md-4">
          <div class="small text-muted">Cliente</div>
          <div class="fw-semibold"><?= htmlspecialchars($venta['ID_CLIENTE'] ?? 'N/D') ?></div>
        </div>
        <div class="col-md-4">
          <div class="small text-muted">Fecha</div>
          <div class="fw-semibold"><?= htmlspecialchars($venta['FECHA'] ?? 'N/D') ?></div>
        </div>
        <div class="col-md-4">
          <div class="small text-muted">Total</div>
          <div class="fw-bold fs-5">₡<?= number_format(($venta['TOTAL'] ?? 0), 2, ',', '.') ?></div>
        </div>
      </div>
    </div>

    <!-- Form de cierre -->
    <form method="post" class="form-card rounded-4 p-3 p-md-4">
      <div class="row g-3 align-items-end">
        <div class="col-md-6">
          <label class="form-label fw-semibold">Método de pago</label>
          <select name="id_metodo_pago" class="form-select rounded-pill" required>
            <option value="">-- Seleccione --</option>
            <?php foreach ($metodos as $m): ?>
              <option value="<?= $m['ID_METODO_PAGO'] ?>">
                <?= htmlspecialchars($m['METODO_PAGO']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-6 text-md-end">
          <button type="submit" class="btn btn-accent rounded-pill">
            <i class="bi bi-receipt-cutoff me-1"></i> Generar factura y pago
          </button>
        </div>
      </div>
    </form>

  </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
