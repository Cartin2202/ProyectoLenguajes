<?php
require_once 'controllers/ClientesController.php';

$controller = new ClientesController();

$cedula  = $_GET['cedula'];
$cliente = $controller->obtenerClientesPorCedula($cedula);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Actualizar Cliente</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap + tu CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css?v=1">
  <!-- (Opcional) Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<?php include('views/partials/header.php'); ?>
<?php include('views/partials/navbar.php'); ?>

<section class="section-box rounded-4 shadow-sm my-4">
  <div class="container py-4">

    <div class="form-card rounded-4 p-3 p-md-4">
      <h2 class="fw-bold mb-4">
        <i class="bi bi-person-gear me-2"></i> Actualizar Cliente
      </h2>

      <form action="clientes.php?accion=actualizar" method="POST" class="row g-3">
        <div class="col-md-4">
          <label class="form-label fw-semibold">Cédula</label>
          <input type="number" name="cedula" id="cedula"
                 class="form-control rounded-pill"
                 value="<?= htmlspecialchars($cliente['CEDULA'] ?? '') ?>" required>
        </div>

        <div class="col-md-4">
          <label class="form-label fw-semibold">Nombre</label>
          <input type="text" name="nombre" id="nombre"
                 class="form-control rounded-pill"
                 value="<?= htmlspecialchars($cliente['NOMBRE'] ?? '') ?>" required>
        </div>

        <div class="col-md-4">
          <label class="form-label fw-semibold">Primer Apellido</label>
          <input type="text" name="apellido1" id="apellido1"
                 class="form-control rounded-pill"
                 value="<?= htmlspecialchars($cliente['PRIMER_APELLIDO'] ?? '') ?>" required>
        </div>

        <div class="col-md-4">
          <label class="form-label fw-semibold">Segundo Apellido</label>
          <input type="text" name="apellido2" id="apellido2"
                 class="form-control rounded-pill"
                 value="<?= htmlspecialchars($cliente['SEGUNDO_APELLIDO'] ?? '') ?>" required>
        </div>

        <div class="col-md-4">
          <label class="form-label fw-semibold">Usuario</label>
          <input type="text" name="usuario" id="usuario"
                 class="form-control rounded-pill"
                 value="<?= htmlspecialchars($cliente['NOMBRE_USUARIO'] ?? '') ?>" required>
        </div>

        <div class="col-md-4">
          <label class="form-label fw-semibold">Correo</label>
          <input type="email" name="correo" id="correo"
                 class="form-control rounded-pill"
                 value="<?= htmlspecialchars($cliente['CORREO'] ?? '') ?>" required>
        </div>

        <div class="col-md-4">
          <label class="form-label fw-semibold">Contraseña</label>
          <input type="password" name="pass" id="pass"
                 class="form-control rounded-pill"
                 value="<?= htmlspecialchars($cliente['PASS'] ?? '') ?>" required>
        </div>

        <div class="col-md-4">
          <label class="form-label fw-semibold">Fecha de nacimiento</label>
          <input type="date" name="fecha" id="fecha"
                 class="form-control rounded-pill"
                 value="<?= isset($cliente['FECHA_NACIMIENTO']) ? htmlspecialchars(date('Y-m-d', strtotime($cliente['FECHA_NACIMIENTO']))) : '' ?>"
                 required>
        </div>

        <div class="col-md-4">
          <label class="form-label fw-semibold">Estado</label>
          <select name="estado" id="estado" class="form-select rounded-pill" required>
            <option value="1" <?= (isset($cliente['ID_ESTADO']) && $cliente['ID_ESTADO'] == 1) ? 'selected' : '' ?>>Activo</option>
            <option value="2" <?= (isset($cliente['ID_ESTADO']) && $cliente['ID_ESTADO'] == 2) ? 'selected' : '' ?>>Inactivo</option>
          </select>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-2">
          <button type="submit" class="btn btn-accent rounded-pill">
            <i class="bi bi-check2-circle me-1"></i> Actualizar
          </button>
          <a href="clientes.php" class="btn btn-outline-secondary rounded-pill">Cancelar</a>
        </div>
      </form>
    </div>

  </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php include 'views/partials/footer.php'; ?>
</body>
</html>
