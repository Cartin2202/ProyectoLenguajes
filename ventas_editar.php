<?php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../controllers/VentasController.php';

$vc = new VentasController();
$idVenta = (int)($_GET['id'] ?? 0);
$venta = $vc->obtenerVenta($idVenta);
if (!$venta) { http_response_code(404); exit('Venta no encontrada'); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idProd = (int)($_POST['id_producto'] ?? 0);
  $cant   = (int)($_POST['cantidad'] ?? 0);
  if ($idProd && $cant > 0) {
    $vc->agregarItem($idVenta, $idProd, $cant);
    header("Location: ventas_editar.php?id=" . urlencode($idVenta));
    exit;
  }
}

$conn = (new Conexion())->getConexion();
$q = oci_parse($conn, "SELECT id_producto, nombre FROM FIDE_PRODUCTO_TB WHERE id_estado = 1 ORDER BY nombre");
oci_execute($q); $prods=[]; while($r=oci_fetch_assoc($q)) $prods[]=$r;

$detalle = $vc->listarDetalleVenta($idVenta);


?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar venta #<?= htmlspecialchars($idVenta) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css?v=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<section class="section-box rounded-4 shadow-sm my-4">
  <div class="container py-4">

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
      <h2 class="m-0 fw-bold">Editar venta #<?= htmlspecialchars($idVenta) ?></h2>
      <div class="small text-muted">
        Cliente: <span class="fw-semibold"><?= htmlspecialchars($venta['ID_CLIENTE']) ?></span> &nbsp;|&nbsp;
        Fecha: <span class="fw-semibold"><?= htmlspecialchars($venta['FECHA']) ?></span>
      </div>
    </div>

    <div class="form-card rounded-4 p-3 p-md-4 mb-4">
      <h5 class="fw-bold mb-3"><i class="bi bi-cart-plus me-2"></i>Agregar producto</h5>
      <form method="post" class="row g-3 align-items-end">
        <div class="col-md-8">
          <label class="form-label fw-semibold">Producto</label>
          <select name="id_producto" class="form-select rounded-pill" required>
            <option value="">-- Producto --</option>
            <?php foreach ($prods as $p): ?>
              <option value="<?= $p['ID_PRODUCTO'] ?>"><?= htmlspecialchars($p['NOMBRE']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-2">
          <label class="form-label fw-semibold">Cantidad</label>
          <input type="number" name="cantidad" min="1" value="1" class="form-control rounded-pill" required>
        </div>
        <div class="col-md-2 text-md-end">
          <button type="submit" class="btn btn-accent rounded-pill w-100">
            <i class="bi bi-plus-lg me-1"></i> Agregar
          </button>
        </div>
      </form>
    </div>

    <div class="table-responsive rounded-4 overflow-hidden shadow-sm">
      <table class="table table-elegant align-middle mb-0">
        <thead>
          <tr>
            <th>Producto</th>
            <th class="text-center" style="width:110px;">Cant</th>
            <th class="text-center" style="width:140px;">Precio</th>
            <th class="text-center" style="width:160px;">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php $acum=0; foreach($detalle as $d): $sub=$d['CANTIDAD']*$d['PRECIO_UNITARIO']; $acum+=$sub; ?>
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
        <?php
          $totalVenta = $venta['TOTAL'];
          if ($totalVenta === null) $totalVenta = $acum; 
        ?>
        <tfoot>
          <tr>
            <th colspan="3" class="text-end">Total venta</th>
            <th class="text-center">₡<?= number_format($totalVenta, 2, ',', '.') ?></th>
          </tr>
        </tfoot>
      </table>
    </div>

    <div class="d-flex flex-wrap gap-2 mt-3">
      <a href="ventas_cerrar.php?id=<?= urlencode($idVenta) ?>" class="btn btn-accent rounded-pill">
        <i class="bi bi-receipt-cutoff me-1"></i> Cerrar venta
      </a>
      <a href="ventas_nueva.php" class="btn btn-outline-secondary rounded-pill">
        Nueva venta
      </a>
    </div>

  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

