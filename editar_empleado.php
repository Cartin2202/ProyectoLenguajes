<?php include 'partials/header.php'; ?>
<?php include 'partials/navbar.php'; ?>

<section class="section-box rounded-4 shadow-sm my-4">
  <div class="container py-4">
    <div class="form-card rounded-4 p-3 p-md-4">
      <h2 class="fw-bold mb-4 text-center">
        <i class="bi bi-person-bounding-box me-2"></i> Editar Empleado
      </h2>

      <form method="post" action="controllers/empleadoscontroller.php?accion=actualizar">
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label fw-semibold">Cédula</label>
            <input type="text" class="form-control rounded-pill" name="cedula"
                   value="<?= htmlspecialchars($empleado['CEDULA']) ?>" readonly>
          </div>
          <div class="col-md-4">
            <label class="form-label fw-semibold">Nombre</label>
            <input type="text" class="form-control rounded-pill" name="nombre"
                   value="<?= htmlspecialchars($empleado['NOMBRE']) ?>" required>
          </div>
          <div class="col-md-4">
            <label class="form-label fw-semibold">Primer Apellido</label>
            <input type="text" class="form-control rounded-pill" name="apellido1"
                   value="<?= htmlspecialchars($empleado['PRIMER_APELLIDO']) ?>" required>
          </div>

          <div class="col-md-4">
            <label class="form-label fw-semibold">Segundo Apellido</label>
            <input type="text" class="form-control rounded-pill" name="apellido2"
                   value="<?= htmlspecialchars($empleado['SEGUNDO_APELLIDO']) ?>">
          </div>
          <div class="col-md-4">
            <label class="form-label fw-semibold">Usuario</label>
            <input type="text" class="form-control rounded-pill" name="usuario"
                   value="<?= htmlspecialchars($empleado['NOMBRE_USUARIO']) ?>" required>
          </div>
          <div class="col-md-4">
            <label class="form-label fw-semibold">Contraseña</label>
            <input type="password" class="form-control rounded-pill" name="pass"
                   value="<?= htmlspecialchars($empleado['CONTRASEÑA']) ?>" required>
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">Correo</label>
            <input type="email" class="form-control rounded-pill" name="correo"
                   value="<?= htmlspecialchars($empleado['CORREO']) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-semibold">Fecha Nacimiento</label>
            <input type="date" class="form-control rounded-pill" name="fecha"
                   value="<?= htmlspecialchars(date('Y-m-d', strtotime($empleado['FECHA_NACIMIENTO']))) ?>" required>
          </div>

          <div class="col-md-4">
            <label class="form-label fw-semibold">Salario</label>
            <input type="number" class="form-control rounded-pill" name="salario"
                   value="<?= htmlspecialchars($empleado['SALARIO']) ?>" required>
          </div>
          <div class="col-md-4">
            <label class="form-label fw-semibold">Puesto (ID)</label>
            <input type="number" class="form-control rounded-pill" name="puesto"
                   value="<?= htmlspecialchars($empleado['ID_PUESTO_USUARIO']) ?>" required>
          </div>
          <div class="col-md-2">
            <label class="form-label fw-semibold">Tipo (ID)</label>
            <input type="number" class="form-control rounded-pill" name="tipo"
                   value="<?= htmlspecialchars($empleado['ID_TIPO_USUARIO']) ?>" readonly>
          </div>
          <div class="col-md-2">
            <label class="form-label fw-semibold">Rol (ID)</label>
            <input type="number" class="form-control rounded-pill" name="rol"
                   value="<?= htmlspecialchars($empleado['ID_ROL_USUARIO']) ?>" required>
          </div>
        </div>

        <div class="d-flex justify-content-center gap-2 mt-4">
          <button type="submit" class="btn btn-accent rounded-pill px-4">
            <i class="bi bi-check2-circle me-1"></i> Guardar Cambios
          </button>
          <a href="empleados.php" class="btn btn-outline-secondary rounded-pill px-4">
            Cancelar
          </a>
        </div>
      </form>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


