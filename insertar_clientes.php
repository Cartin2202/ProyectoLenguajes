<?php
include('views/partials/header.php');
include('views/partials/navbar.php');
require_once 'controllers/ClientesController.php';
$status = $_GET['status'] ?? '';
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<section class="section-box rounded-4 shadow-sm my-4">
  <div class="container py-4">

    <div class="form-card rounded-4 p-3 p-md-4">
      <h2 class="fw-bold mb-4">
        <i class="bi bi-person-plus me-2"></i> Agregar Clientes
      </h2>

      <?php if ($status === 'ok'): ?>
        <div class="alert alert-success rounded-4">Cliente registrado correctamente.</div>
      <?php elseif ($status === 'error'): ?>
        <div class="alert alert-danger rounded-4">Ocurrió un error al registrar el cliente.</div>
      <?php endif; ?>

      <form action="clientes.php?accion=registrar" method="POST" class="row g-3">
        <div class="col-md-4">
          <label class="form-label fw-semibold">Cédula</label>
          <input type="text" name="cedula" id="cedula" class="form-control rounded-pill" required>
        </div>

        <div class="col-md-4">
          <label class="form-label fw-semibold">Nombre</label>
          <input type="text" name="nombre" id="nombre" class="form-control rounded-pill" required>
        </div>
        <div class="col-md-4">
          <label class="form-label fw-semibold">Primer Apellido</label>
          <input type="text" name="apellido1" id="apellido1" class="form-control rounded-pill" required>
        </div>
        <div class="col-md-4">
          <label class="form-label fw-semibold">Segundo Apellido</label>
          <input type="text" name="apellido2" id="apellido2" class="form-control rounded-pill" required>
        </div>

        <div class="col-md-4">
          <label class="form-label fw-semibold">Usuario</label>
          <input type="text" name="usuario" id="usuario" class="form-control rounded-pill" required>
        </div>
        <div class="col-md-4">
          <label class="form-label fw-semibold">Contraseña</label>
          <input type="password" name="pass" id="pass" class="form-control rounded-pill" required>
        </div>

        <div class="col-md-6">
          <label class="form-label fw-semibold">Correo</label>
          <input type="email" name="correo" id="correo" class="form-control rounded-pill" required>
        </div>
        <div class="col-md-6">
          <label class="form-label fw-semibold">Fecha de nacimiento</label>
          <input type="date" name="fecha" id="fecha" class="form-control rounded-pill" required>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-2">
          <button type="submit" class="btn btn-accent rounded-pill">
            <i class="bi bi-check2-circle me-1"></i> Registrar
          </button>
          <a href="clientes.php" class="btn btn-outline-secondary rounded-pill">Cancelar</a>
        </div>
      </form>
    </div>

  </div>
</section>

<!-- Bootstrap JS (si no está ya en header.php) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php include 'views/partials/footer.php'; ?>