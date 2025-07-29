<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <link rel="stylesheet" href="/G2_SC504_LN_PROYECTO/assets/css/login.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <div class="container">
    <div class="login">
      <img class="logo" src="/G2_SC504_LN_PROYECTO/assets/img/image.png" alt="Logo">

      <h2>Ingrese sus credenciales</h2>

      <form method="post" action="controllers/LoginController.php">
        <div class="form">
          <input type="text" name="usuario" placeholder="Usuario" required>
        </div>
        <div class="form">
          <input type="password" name="contrasena" placeholder="Contraseña" required>
        </div>
        <div>
          <p>¿Olvidó su contraseña?</p>
        </div>

        <button class="btn-login" type="submit">
          Iniciar sesión
        </button>
      </form>

      <div class="mt-3">
        <a href="registro.php" class="btn btn-outline-secondary">Registrarse</a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>

</body>

</html>