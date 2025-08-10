<?php 
include('views/partials/header.php');
include('views/partials/navbar.php');
?> 

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<div class="container mt-4">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <h4>Eliminar Movimiento de Inventario</h4>
    <form method="POST" action="inventario.php?action=eliminar">
        <div class="row mb-3">
            <div class="col">
                <label>ID Movimiento</label>
                <input type="number" name="id_movimiento" class="form-control" required>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-danger mt-4">Eliminar</button>
            </div>
        </div>
    </form>
    <hr>
</div>
