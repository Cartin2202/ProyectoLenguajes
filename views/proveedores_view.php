<?php include 'partials/navbar.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Consulta de Proveedores</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons (opcional, por si usas iconos) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Tu CSS -->
  <link rel="stylesheet" href="assets/css/styles.css?v=4">
</head>
<body>

<section class="section-box rounded-4 shadow-sm my-4">
  <div class="container py-4">

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-2 gap-2">
      <h2 class="m-0 fw-bold">Lista de Proveedores</h2>
      <p class="m-0 text-muted">Visualice todos los proveedores registrados en el sistema.</p>
    </div>

    <div class="table-responsive rounded-4 overflow-hidden shadow-sm mt-3">
      <table class="table table-elegant align-middle mb-0">
        <thead>
          <tr class="text-center">
            <th style="width:120px;">ID</th>
            <th>Empresa</th>
            <th>Correo</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <?php if (!empty($proveedores)): ?>
            <?php foreach ($proveedores as $prov): ?>
              <tr>
                <td class="fw-semibold"><?= htmlspecialchars($prov['ID_PROVEEDOR']) ?></td>
                <td><?= htmlspecialchars($prov['NOMBRE_EMPRESA']) ?></td>
                <td><?= htmlspecialchars($prov['CORREO']) ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="3" class="text-center py-4">No hay proveedores registrados.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

  </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
