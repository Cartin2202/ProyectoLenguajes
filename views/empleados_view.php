<?php include 'partials/header.php'; ?>
<?php include 'partials/navbar.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<section class="section-box rounded-4 shadow-sm my-4">
  <div class="container py-4">

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
      <h2 class="m-0 fw-bold">Gestión de Empleados</h2>
      <div class="d-flex gap-2">
        <a href="registrar_empleado.php" class="btn btn-accent rounded-pill">
          <i class="bi bi-person-plus"></i> Nuevo
        </a>
      </div>
    </div>

    <div class="table-responsive rounded-4 overflow-hidden shadow-sm">
      <table class="table table-elegant table-hover align-middle mb-0">
        <thead>
          <tr class="text-center">
            <th>Cédula</th>
            <th>Nombre</th>
            <th>Primer Apellido</th>
            <th>Segundo Apellido</th>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Rol</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($empleados)): ?>
            <?php foreach ($empleados as $empleado): ?>
              <tr class="text-center">
                <td><?= htmlspecialchars($empleado['CEDULA']) ?></td>
                <td><?= htmlspecialchars($empleado['NOMBRE']) ?></td>
                <td><?= htmlspecialchars($empleado['APELLIDO1']) ?></td>
                <td><?= htmlspecialchars($empleado['APELLIDO2']) ?></td>
                <td><?= htmlspecialchars($empleado['USUARIO']) ?></td>
                <td><?= htmlspecialchars($empleado['CORREO']) ?></td>
                <td><?= htmlspecialchars($empleado['ROL']) ?></td>
                <td>
                  
                  <?php if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'VENDEDOR'): ?>
                  <div class="d-inline-flex gap-2">
                    <a href="actualizar_empleado.php?cedula=<?= urlencode($empleado['CEDULA']) ?>"
                       class="btn btn-outline-secondary btn-sm rounded-pill" title="Editar">
                      <i class="bi bi-pencil-square"></i> Editar
                    </a>
                    <a href="eliminar_empleado.php?cedula=<?= urlencode($empleado['CEDULA']) ?>"
                       class="btn btn-outline-danger btn-sm rounded-pill"
                       onclick="return confirm('¿Está seguro que desea eliminar este empleado?')"
                       title="Eliminar">
                      <i class="bi bi-trash"></i> Eliminar
                    </a>
                  </div>
                <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="8" class="text-center py-4">No hay empleados registrados.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
