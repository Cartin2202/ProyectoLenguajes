<?php 
include('views/partials/header.php');
include('views/partials/navbar.php');
?> 

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<section class="section-box rounded-4 shadow-sm my-4">
  <div class="container py-4">
    <div class="form-card rounded-4 p-3 p-md-4">
      <h4 class="fw-bold mb-3">
        <i class="bi bi-link-45deg me-2"></i> Asociar Producto a Movimiento
      </h4>

      <form method="POST" action="inventario.php?action=asociar">
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label fw-semibold">ID Movimiento</label>
            <input type="number" name="id_movimiento" class="form-control rounded-pill" required>
          </div>
          <div class="col-md-4">
            <label class="form-label fw-semibold">ID Producto</label>
            <input type="number" name="id_producto" class="form-control rounded-pill" required>
          </div>
          <div class="col-md-4">
            <label class="form-label fw-semibold">Cantidad</label>
            <input type="number" name="cantidad" class="form-control rounded-pill" required>
          </div>
        </div>

        <div class="mt-3">
          <button type="submit" class="btn btn-outline-accent rounded-pill">
            <i class="bi bi-plus-lg me-1"></i> Asociar Producto
          </button>
        </div>
      </form>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
