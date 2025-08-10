<?php include('views/partials/header.php'); ?>
<?php include('views/partials/navbar.php'); ?>

<section class="py-5">
  <div class="container">
    <h2 class="mb-4 text-center">Registro de Usuario</h2>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form method="post" action="/G2_SC504_LN_PROYECTO/controllers/InsertarUsuarioController.php">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Cédula</label>
              <input type="text" class="form-control" name="cedula" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Nombre</label>
              <input type="text" class="form-control" name="nombre" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Primer Apellido</label>
              <input type="text" class="form-control" name="primer_apellido" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Segundo Apellido</label>
              <input type="text" class="form-control" name="segundo_apellido">
            </div>
            <div class="col-md-6">
              <label class="form-label">Usuario</label>
              <input type="text" class="form-control" name="nombre_usuario" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Contraseña</label>
              <input type="password" class="form-control" name="contrasena" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Correo</label>
              <input type="email" class="form-control" name="correo" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Fecha Nacimiento</label>
              <input type="date" class="form-control" name="fecha_nacimiento" required>
            </div>
          </div>
          <div class="mt-4 text-center">
            <button type="submit" class="btn btn-dark w-50">Registrar</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</section>

<?php include('views/partials/footer.php'); ?>