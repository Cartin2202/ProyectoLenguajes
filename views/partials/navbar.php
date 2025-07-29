<?php session_start(); ?>

<?php if (isset($_SESSION['usuario'])): ?>
  <span class="navbar-text me-3">Hola, <?= $_SESSION['usuario'] ?></span>
  <a class="btn btn-sm btn-outline-dark" href="controllers/LogoutController.php">Cerrar sesión</a>
<?php endif; ?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">Piedras & Enchapes</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active fw-bold' : '' ?>" href="index.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'about_us.php' ? 'active fw-bold' : '' ?>" href="about_us.php">Sobre Nosotros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active fw-bold' : '' ?>" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'productos.php' ? 'active fw-bold' : '' ?>" href="productos.php">Piedras Decorativas</a>
        </li>
      </ul>
    </div>
  </div>
</nav>