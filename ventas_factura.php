<?php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../controllers/VentasController.php';

$vc        = new VentasController();
$idVenta   = (int)($_GET['venta'] ?? 0);
$idFactura = (int)($_GET['id_factura'] ?? 0);

$venta   = $vc->obtenerVenta($idVenta);
if (!$venta) { http_response_code(404); exit('Venta no encontrada'); }

$detalle = $vc->listarDetalleVenta($idVenta);

$archivoTxt = null;
if (isset($_GET['gen_txt'])) {
  $archivoTxt = $vc->generarFacturaTxt($idVenta);
}


?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Factura #<?= htmlspecialchars($idFactura) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css?v=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<section class="section-box rounded-4 shadow-sm my-4">
  <div class="container py-4">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
      <h2 class="m-0 fw-bold">
        <i class="bi bi-receipt me-2"></i> Factura #<?= htmlspecialchars($idFactura) ?>
      </h2>

      <div class="d-flex flex-wrap gap-2">
        <a href="ventas_nueva.php" class="btn btn-outline-secondary rounded-pill">
          <i class="bi bi-plus-circle"></i> Nueva venta
        </a>
      </div>
    </div>

    <div class="form-card rounded-4 p-3 p-md-4 mb-4">
      <div class="row g-3">
        <div class="col-md-3">
          <div class="small text-muted">Venta</div>
          <div class="fw-semibold"><?= htmlspecialchars($venta['ID_VENTA']) ?></div>
        </div>
        <div class="col-md-3">
          <div class="small text-muted">Cliente</div>
          <div class="fw-semibold"><?= htmlspecialchars($venta['ID_CLIENTE']) ?></div>
        </div>
        <div class="col-md-3">
          <div class="small text-muted">Fecha</div>
          <div class="fw-semibold"><?= htmlspecialchars($venta['FECHA']) ?></div>
        </div>
        <div class="col-md-3">
          <div class="small text-muted">Total</div>
          <div class="fw-bold fs-5">₡<?= number_format(($venta['TOTAL'] ?? 0), 2, ',', '.') ?></div>
        </div>
      </div>
    </div>

    <div class="table-responsive rounded-4 overflow-hidden shadow-sm mb-3">
      <table class="table table-elegant align-middle mb-0">
        <thead>
          <tr>
            <th>Producto</th>
            <th class="text-center" style="width:110px;">Cantidad</th>
            <th class="text-center" style="width:140px;">Precio</th>
            <th class="text-center" style="width:160px;">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($detalle as $d): $sub = $d['CANTIDAD'] * $d['PRECIO_UNITARIO']; ?>
            <tr>
              <td><?= htmlspecialchars($d['NOMBRE_PRODUCTO'] ?? ('#'.$d['ID_PRODUCTO'])) ?></td>
              <td class="text-center"><?= (int)$d['CANTIDAD'] ?></td>
              <td class="text-center">₡<?= number_format($d['PRECIO_UNITARIO'], 2, ',', '.') ?></td>
              <td class="text-center">₡<?= number_format($sub, 2, ',', '.') ?></td>
            </tr>
          <?php endforeach; ?>
          <?php if (empty($detalle)): ?>
            <tr><td colspan="4" class="text-center py-4">Sin detalle.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="d-flex flex-wrap gap-2">
      <a href="?venta=<?= urlencode($idVenta) ?>&id_factura=<?= urlencode($idFactura) ?>&gen_txt=1"
         class="btn btn-outline-accent rounded-pill">
        <i class="bi bi-filetype-txt me-1"></i> Generar TXT
      </a>

      <?php if ($archivoTxt): ?>
        <a href="../<?= htmlspecialchars($archivoTxt) ?>" download
           class="btn btn-accent rounded-pill">
          <i class="bi bi-download me-1"></i> Descargar TXT
        </a>
      <?php endif; ?>

      <a href="ventas_editar.php?id=<?= urlencode($idVenta) ?>" class="btn btn-outline-secondary rounded-pill">
        <i class="bi bi-arrow-left"></i> Volver a la venta
      </a>
    </div>

  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

