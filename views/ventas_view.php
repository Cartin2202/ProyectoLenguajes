<section class="section-box rounded-4 shadow-sm my-4">
  <div class="container py-4">

    <h3 class="fw-bold mb-3">Ventas</h3>

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger rounded-4"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <div class="row g-4">
      <!-- Listado -->
      <div class="col-lg-7">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <h5 class="mb-0 fw-semibold">Listado</h5>
        </div>

        <div class="table-responsive rounded-4 overflow-hidden shadow-sm">
          <table class="table table-elegant table-sm align-middle mb-0">
            <thead>
              <tr class="text-center">
                <th style="width:110px;">ID</th>
                <th>Cliente</th>
                <th style="width:140px;">Total</th>
                <th style="width:160px;">Fecha</th>
                <th style="width:210px;"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($ventas as $v): ?>
                <tr>
                  <td class="text-center"><?= $v['ID_VENTA'] ?></td>
                  <td><?= htmlspecialchars(($v['NOMBRE_CLIENTE'] ?? '').' '.($v['APELLIDO_CLIENTE'] ?? '')) ?></td>
                  <td class="text-center">₡<?= number_format(($v['TOTAL'] ?? 0), 2, ',', '.') ?></td>
                  <td class="text-center"><?= $v['FECHA'] ?? '' ?></td>
                  <td class="text-center">
                    <div class="d-inline-flex gap-2">
                      <a class="btn btn-sm btn-outline-secondary rounded-pill"
                         href="ventas.php?ver=<?= $v['ID_VENTA'] ?>">Ver</a>
                      <a class="btn btn-sm btn-outline-accent rounded-pill"
                         href="ventas.php?action=factura&id=<?= $v['ID_VENTA'] ?>">Factura .txt</a>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>

              <?php if (empty($ventas)): ?>
                <tr><td colspan="5" class="text-center py-4">Sin ventas.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Detalle -->
      <div class="col-lg-5">
        <h5 class="fw-semibold mb-3">Detalle <?= $ventaId ? "Venta #$ventaId" : '' ?></h5>

        <?php if ($ventaId && $ventaSel): ?>
          <div class="form-card rounded-4 p-3 mb-3">
            <div class="row g-2 small">
              <div class="col-6"><strong>Cliente ID:</strong> <?= $ventaSel['ID_CLIENTE'] ?? 'N/D' ?></div>
              <div class="col-6 text-lg-end"><strong>Fecha:</strong> <?= $ventaSel['FECHA'] ?? 'N/D' ?></div>
              <div class="col-12"><strong>Total:</strong> ₡<?= number_format(($ventaSel['TOTAL'] ?? 0), 2, ',', '.') ?></div>
            </div>
          </div>

          <div class="table-responsive rounded-4 overflow-hidden shadow-sm mb-3">
            <table class="table table-sm table-elegant mb-0">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th style="width:90px;" class="text-center">Cant</th>
                  <th style="width:120px;" class="text-center">Unit</th>
                  <th style="width:140px;" class="text-center">Subtotal</th>
                </tr>
              </thead>
              <tbody>
                <?php $tot=0; foreach($detalle as $d): $sub=$d['PRECIO_UNITARIO']*$d['CANTIDAD']; $tot+=$sub; ?>
                  <tr>
                    <td><?= htmlspecialchars($d['NOMBRE_PRODUCTO'] ?? ('PROD '.$d['ID_PRODUCTO'])) ?></td>
                    <td class="text-center"><?= (int)$d['CANTIDAD'] ?></td>
                    <td class="text-center">₡<?= number_format($d['PRECIO_UNITARIO'], 2, ',', '.') ?></td>
                    <td class="text-center">₡<?= number_format($sub, 2, ',', '.') ?></td>
                  </tr>
                <?php endforeach; ?>

                <?php if (empty($detalle)): ?>
                  <tr><td colspan="4" class="text-center py-3">Sin detalle.</td></tr>
                <?php endif; ?>
              </tbody>

              <?php if(!empty($detalle)): ?>
                <tfoot>
                  <tr>
                    <th colspan="3" class="text-end">Total</th>
                    <th class="text-center">₡<?= number_format($tot,2, ',', '.') ?></th>
                  </tr>
                </tfoot>
              <?php endif; ?>
            </table>
          </div>

          <a class="btn btn-accent btn-sm rounded-pill"
             href="ventas.php?action=factura&id=<?= $ventaId ?>">
            Descargar factura (.txt)
          </a>
        <?php else: ?>
          <div class="alert alert-info rounded-4">Seleccione una venta para ver el detalle.</div>
        <?php endif; ?>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </div>
</section>
