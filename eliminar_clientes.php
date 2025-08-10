<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Eliminar Cliente</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap + tu CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css?v=1">
  <!-- (opcional) íconos -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<?php include('views/partials/header.php'); ?>
<?php include('views/partials/navbar.php'); ?>

<section class="section-box rounded-4 shadow-sm my-4">
  <div class="container py-4">

    <div class="form-card rounded-4 p-3 p-md-4">
      <h2 class="fw-bold mb-4">
        <i class="bi bi-person-dash me-2"></i> Eliminar Cliente
      </h2>

      <form id="formEliminar" action="clientes.php?accion=eliminar" method="POST">
        <div class="mb-3">
          <label for="cedula" class="form-label fw-semibold">Cédula del Cliente</label>
          <input type="number" class="form-control rounded-pill" id="cedula" name="cedula" required>
        </div>

        <div class="d-flex gap-2">
          <!-- Botón que abre el modal -->
          <button type="button" class="btn btn-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#confirmModal">
            <i class="bi bi-trash me-1"></i> Eliminar
          </button>
          <a href="clientes.php" class="btn btn-outline-secondary rounded-pill">Cancelar</a>
        </div>

        <!-- Modal de confirmación -->
        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
              <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirmar eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
              </div>
              <div class="modal-body">
                ¿Estás seguro que deseas eliminar este cliente?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                <!-- Botón submit que envía el formulario -->
                <button type="submit" class="btn btn-danger rounded-pill">
                  <i class="bi bi-check2-circle me-1"></i> Sí, eliminar
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- /Modal -->
      </form>
    </div>

  </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
