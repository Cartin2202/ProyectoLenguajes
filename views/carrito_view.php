<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$flash_success = $_SESSION['flash_success'] ?? null;
$flash_error   = $_SESSION['flash_error'] ?? null;
unset($_SESSION['flash_success'], $_SESSION['flash_error']);

$carrito  = $datos['carrito']  ?? [];
$total    = $datos['total']    ?? 0;
$clientes = $datos['clientes'] ?? [];
$metodos  = $datos['metodos']  ?? [];
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<section class="section-box rounded-4 shadow-sm my-4">
  <div class="container py-4">

    <h3 class="fw-bold mb-3">Carrito</h3>

    <?php if ($flash_success): ?>
      <div class="alert alert-success rounded-4"><?= htmlspecialchars($flash_success) ?></div>
    <?php endif; ?>

    <?php if ($flash_error): ?>
      <div class="alert alert-danger rounded-4"><?= htmlspecialchars($flash_error) ?></div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger rounded-4"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if (empty($carrito)): ?>
      <div class="alert alert-warning rounded-4">Tu carrito está vacío.</div>
    <?php else: ?>

      <form method="post" action="carrito.php?action=update" class="mb-3">
        <div class="table-responsive rounded-4 overflow-hidden shadow-sm">
          <table class="table table-elegant align-middle mb-0">
            <thead>
              <tr class="text-center">
                <th>Producto</th>
                <th style="width:140px">Precio</th>
                <th style="width:160px">Cantidad</th>
                <th style="width:160px">Subtotal</th>
                <th style="width:90px"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($carrito as $it): ?>
                <tr>
                  <td><?= htmlspecialchars($it['nombre']) ?></td>
                  <td class="text-center">₡<?= number_format((float)$it['precio'], 2, ',', '.') ?></td>
                  <td class="text-center">
                    <input type="number" min="1" name="cant[<?= (int)$it['id'] ?>]"
                           value="<?= (int)$it['cantidad'] ?>"
                           class="form-control form-control-sm rounded-pill mx-auto" style="max-width:120px;">
                  </td>
                  <td class="text-center">₡<?= number_format((float)$it['precio'] * (int)$it['cantidad'], 2, ',', '.') ?></td>
                  <td class="text-center">
                    <a class="btn btn-sm btn-outline-danger rounded-pill"
                       href="carrito.php?action=remove&id=<?= (int)$it['id'] ?>">Quitar</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <th colspan="3" class="text-end">Total</th>
                <th class="text-center">₡<?= number_format((float)$total, 2, ',', '.') ?></th>
                <th></th>
              </tr>
            </tfoot>
          </table>
        </div>

        <div class="d-flex flex-wrap gap-2 mt-3">
          <button class="btn btn-sm btn-outline-secondary rounded-pill">Actualizar cantidades</button>
          <a class="btn btn-sm btn-outline-danger rounded-pill" href="carrito.php?action=clear">Vaciar carrito</a>
        </div>
      </form>

      <hr class="my-4">

      <h5 class="fw-bold mb-3">Finalizar compra</h5>
      <form method="post" action="carrito.php?action=checkout" class="row g-3">
        <div class="col-md-4">
          <label class="form-label fw-semibold">Cliente</label>
          <select name="cliente_id" class="form-select rounded-pill" required>
            <option value="">Seleccione cliente</option>
            <?php foreach ($clientes as $c):
              $ced    = $c['CEDULA'] ?? null;
              $nom    = trim(($c['NOMBRE'] ?? '').' '.($c['PRIMER_APELLIDO'] ?? '').' '.($c['SEGUNDO_APELLIDO'] ?? ''));
              $correo = $c['CORREO'] ?? null;
            ?>
              <option value="<?= htmlspecialchars($ced) ?>">
                <?= htmlspecialchars($nom ?: ('Cliente '.$ced)) ?>
                <?= $correo ? ' ('.htmlspecialchars($correo).')' : '' ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-4">
          <label class="form-label fw-semibold">Método de pago</label>
          <select name="metodo_pago" class="form-select rounded-pill" required>
            <option value="">Seleccione método</option>
            <?php foreach ($metodos as $m): ?>
              <option value="<?= htmlspecialchars($m['ID_METODO_PAGO']) ?>">
                <?= htmlspecialchars($m['METODO_PAGO'] ?? ($m['METODO'] ?? '')) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-4 align-self-end">
          <button class="btn btn-accent rounded-pill w-100">
            Pagar
          </button>
        </div>
      </form>

    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </div>
</section>
