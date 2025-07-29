<section class="py-4 mx-3 rounded">
  <div class="container">
    <form method="get" class="mb-4">
      <div class="row">
        <div class="col-md-6">
          <select name="categoria" class="form-select" onchange="this.form.submit()">
            <option value="0">-- Todas las categorías --</option>
            <?php foreach ($categorias as $cat): ?>
              <option value="<?= $cat['ID_CATEGORIA'] ?>" <?= ($filtro_categoria == $cat['ID_CATEGORIA']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['NOMBRE']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
    </form>

    <div class="row g-4">
      <?php $hay_resultados = false; ?>
      <?php foreach ($productos as $prod): ?>
        <?php $hay_resultados = true; ?>
        <div class="col-md-4">
          <div class="custom-card card h-100 shadow-sm p-2">
            <img src="<?= htmlspecialchars($prod['IMAGEN'] ?? './assets/img/sample-img.jpg') ?>" class="card-img-top" alt="<?= htmlspecialchars($prod['NOMBRE']) ?>">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($prod['NOMBRE']) ?></h5>
              <p class="card-text"><?= htmlspecialchars($prod['DESCRIPCION']) ?></p>
              <p><strong>Precio:</strong> ₡<?= number_format($prod["PRECIO_UNITARIO"], 0, ',', '.') ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>

      <?php if (!$hay_resultados): ?>
        <div class="col-12">
          <div class="alert alert-warning text-center">
            No se encontraron productos para esta categoría.
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
