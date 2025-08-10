<?php
require_once 'models/ClientesModel.php';

$model = new ClientesModel();
$clientes = $model->obtenerClientes();

include('views/partials/header.php');
include('views/partials/navbar.php');
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
              <th style="width:160px;"></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($clientes as $cliente): ?>
              <tr>
                <td class="text-center"><?= htmlspecialchars($cliente['CEDULA']) ?></td>
                <td><?= htmlspecialchars($cliente['NOMBRE']) . ' ' . htmlspecialchars($cliente['PRIMER_APELLIDO']) . ' ' . htmlspecialchars($cliente['SEGUNDO_APELLIDO']) ?></td>
                <td class="text-center">
                  <a href="actualizar_clientes.php?cedula=<?= urlencode($cliente['CEDULA']) ?>"
                     class="btn btn-outline-secondary btn-sm rounded-pill">
                    Actualizar
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

<!-- Bootstrap JS (si no está ya en header.php) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'views/partials/footer.php'; ?>
