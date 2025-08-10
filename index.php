<?php include('views/partials/header.php'); ?>
<?php include('views/partials/navbar.php'); ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<!-- Sección principal con título -->
<section id="top-tittle" class="hero-section rounded-4 shadow mb-5">
  <div class="container py-5 text-center">
    <h1 class="display-5 fw-bold text-dark">Belleza Natural para tus Espacios</h1>
    <p class="lead text-black-50 mb-4">
      Variedad de piedras decorativas y enchapes de la mejor calidad.
    </p>
    
    <!-- Imagen -->
    <div class="mb-4">
      <img src="./assets/img/sample-img.jpg" class="img-fluid rounded" alt="Imagen principal">
    </div>
    
    <!-- Botón -->
    <div>
      <a href="productos.php" class="btn btn-lg btn-hero rounded-pill px-4">Ver catálogo</a>
    </div>
  </div>
  <div class="hero-bg"></div>
</section>


<!-- Sección bienvenida -->
<section class="section-box rounded-4 shadow-sm mb-5">
  <div class="container py-5">
    <h2 class="mb-3 fw-bold">Bienvenido</h2>
    <p class="lead mb-0">
      Somos una empresa familiar dedicada a ofrecer piedras decorativas y enchapes de alta calidad.
      Navegue por nuestro catálogo para descubrir las mejores opciones para interiores, exteriores y proyectos especiales.
    </p>
  </div>
</section>

<!-- Sección "Sobre Nosotros" -->
<section class="section-soft rounded-4 shadow-sm mb-4 text-center">
  <div class="container py-5">
    <h1 class="display-6 fw-bold">Sobre Nosotros</h1>
    <p class="lead mb-0">
      Conozca más sobre nuestra historia familiar, valores y compromiso con la calidad de nuestros productos.
    </p>
  </div>
</section>

<section class="mb-5 about-section rounded-4 shadow-sm">
  <div class="container">
    <div class="row align-items-center g-4">
      <div class="col-md-6">
        <div class="image-frame rounded-4 shadow-sm">
          <img src="./assets/img/sample-img.jpg" class="img-fluid rounded-4" alt="Quiénes somos">
        </div>
      </div>
      <div class="col-md-6">
        <h3 class="fw-bold mb-3">¿Quiénes somos?</h3>
        <p class="mb-2">
          Gustavo Fallas Piedras Enchapes y Más nace como una empresa familiar dedicada a la comercialización
          de piedras decorativas y enchapes de alta calidad.
        </p>
        <p class="mb-0">
          Desde el día 1, nuestra misión ha sido brindar productos duraderos, estéticos y sostenibles,
          manteniendo siempre un trato confiable y cercano con todos nuestros clientes.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Valores -->
<section class="section-box2 rounded-4 shadow-sm">
  <div class="container py-5">
    <h3 class="mb-4 text-center fw-bold">Nuestros Valores</h3>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="value-card p-4 rounded-4 h-100">
          <h5 class="fw-bold mb-2">Calidad</h5>
          <p class="mb-0">Seleccionamos cuidadosamente cada producto para garantizar durabilidad y estética.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="value-card p-4 rounded-4 h-100">
          <h5 class="fw-bold mb-2">Compromiso</h5>
          <p class="mb-0">Trabajamos con dedicación y excelencia para satisfacer las necesidades de nuestros clientes.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="value-card p-4 rounded-4 h-100">
          <h5 class="fw-bold mb-2">Confianza</h5>
          <p class="mb-0">Construimos relaciones duraderas basadas en respeto, transparencia y confianza.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include('views/partials/footer.php'); ?>
