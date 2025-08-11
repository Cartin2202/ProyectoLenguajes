<?php include('views/partials/header.php'); ?>
<?php include('views/partials/navbar.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Categorías de Productos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/styles.css?v=3">
</head>
<body class="bg-light">


  <section class="section-box rounded-4 shadow-sm my-4">
    <div class="container py-4">

      <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h2 class="m-0 fw-bold">Categorías de Productos</h2>
        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] !== 'CLIENTE' && $_SESSION['rol'] !== 'VENDEDOR'): ?>
        <a href="insertar_categoria.php" class="btn btn-accent rounded-pill">
          <i class="bi bi-plus-lg"></i> Nueva Categoría
        </a>
        <?php endif;?>
      </div>
      
      <?php if (!empty($categorias)): ?>
        <div class="table-responsive">
          <table class="table table-elegant align-middle mb-0 rounded-4 overflow-hidden">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($categorias as $cat): ?>
                <tr>
                  <td class="fw-semibold"><?= $cat['ID_CATEGORIA'] ?></td>
                  <td><?= htmlspecialchars($cat['NOMBRE']) ?></td>
                  <td class="text-end">
                  <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] !== 'CLIENTE' && $_SESSION['rol'] !== 'VENDEDOR'): ?>
                    <div class="d-inline-flex gap-2">
                      <a href="editar_categoria.php?id=<?= $cat['ID_CATEGORIA'] ?>"
                         class="btn btn-outline-secondary btn-sm rounded-pill" title="Editar">
                        <i class="bi bi-pencil-square"></i> Editar
                      </a>
                      <a href="categorias.php?action=eliminar&id=<?= $cat['ID_CATEGORIA'] ?>"
                         class="btn btn-outline-danger btn-sm rounded-pill"
                         onclick="return confirm('¿Desea eliminar esta categoría?')" title="Eliminar">
                        <i class="bi bi-trash"></i> Eliminar
                      </a>
                    </div>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <div class="alert alert-info text-center rounded-4">No hay categorías registradas.</div>
      <?php endif; ?>

    </div>
  </section>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

