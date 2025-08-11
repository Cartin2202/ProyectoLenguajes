<?php
require_once 'models/ClientesModel.php';

$cedulaSeleccionada = $_GET['cedula'] ?? null;
$model = new ClientesModel();

$clientes = $model->obtenerClientes();
$clienteDetalle = null;

if ($cedulaSeleccionada) {
  $clienteDetalle = $model->obtenerClientesPorCedula($cedulaSeleccionada);
}

include('partials/header.php');
include('partials/navbar.php');
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<section class="section-box rounded-4 shadow-sm my-4">
  <div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="m-0 fw-bold">Clientes</h2>
    </div>

    <?php if (!empty($clientes)): ?>
      <div class="table-responsive rounded-4 overflow-hidden shadow-sm">
        <table class="table table-elegant align-middle mb-0">
          <thead>
            <tr class="text-center">
              <th style="width:160px;">Cédula</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th style="width:180px;"></th>
              <th style="width:200px;"></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($clientes as $cliente): ?>
              <tr>
                <td class="text-center"><?= htmlspecialchars($cliente['CEDULA']) ?></td>
                <td><?= htmlspecialchars($cliente['NOMBRE']) . ' ' . htmlspecialchars($cliente['PRIMER_APELLIDO']) . ' ' . htmlspecialchars($cliente['SEGUNDO_APELLIDO']) ?></td>
                <td><?= htmlspecialchars($cliente['CORREO']) ?></td>
                <td class="text-center">
                  <a href="ventasClientes.php?cedula=<?= urlencode($cliente['CEDULA']) ?>"
                     class="btn btn-outline-secondary btn-sm rounded-pill">
                    Detalles Ventas
                  </a>
                </td>
                <td class="text-center">
                  <a href="?cedula=<?= urlencode($cliente['CEDULA']) ?>"
                     class="btn btn-accent btn-sm rounded-pill">
                    Detalles de Cliente
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <div class="alert alert-info rounded-4 text-center">No hay clientes registrados.</div>
    <?php endif; ?>

  </div>
</section>

<?php if ($clienteDetalle): ?>
  <div class="modal fade show d-block" id="modalClienteDetalle" tabindex="-1" aria-labelledby="labelClienteDetalle" aria-modal="true" role="dialog" style="background: rgba(0,0,0,.35);">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content rounded-4">
        <div class="modal-header">
          <h5 class="modal-title fw-bold" id="labelClienteDetalle">Detalles del Cliente</h5>
          <a href="?" class="btn-close" aria-label="Cerrar"></a>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6"><strong>Cédula:</strong> <?= htmlspecialchars($clienteDetalle['CEDULA']) ?></div>
            <div class="col-md-6"><strong>Usuario:</strong> <?= htmlspecialchars($clienteDetalle['NOMBRE_USUARIO']) ?></div>
            <div class="col-md-12"><strong>Nombre:</strong>
              <?= htmlspecialchars($clienteDetalle['NOMBRE']) . ' ' . htmlspecialchars($clienteDetalle['PRIMER_APELLIDO']) . ' ' . htmlspecialchars($clienteDetalle['SEGUNDO_APELLIDO']) ?>
            </div>
            <div class="col-md-6"><strong>Correo:</strong> <?= htmlspecialchars($clienteDetalle['CORREO']) ?></div>
            <div class="col-md-6"><strong>Fecha de nacimiento:</strong> <?= htmlspecialchars($clienteDetalle['FECHA_NACIMIENTO']) ?></div>

            <div class="col-md-4"><strong>Provincia:</strong> <?= htmlspecialchars($clienteDetalle['NOMBRE_PROVINCIA'] ?? 'No registrado') ?></div>
            <div class="col-md-4"><strong>Cantón:</strong> <?= htmlspecialchars($clienteDetalle['NOMBRE_CANTON'] ?? 'No registrado') ?></div>
            <div class="col-md-4"><strong>Distrito:</strong> <?= htmlspecialchars($clienteDetalle['NOMBRE_DISTRITO'] ?? 'No registrado') ?></div>
            <div class="col-md-12"><strong>Dirección:</strong> <?= htmlspecialchars($clienteDetalle['DETALLE_DIRECCION'] ?? 'No registrado') ?></div>
            <div class="col-md-6"><strong>Teléfono:</strong> <?= htmlspecialchars($clienteDetalle['TELEFONO'] ?? 'No registrado') ?></div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="?" class="btn btn-accent rounded-pill">Cerrar</a>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

