<?php
require_once 'models/CategoriasModel.php';

$model = new CategoriasModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $model->insertarCategoria($nombre, $descripcion);
    header('Location: categorias.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Insertar Categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<?php include('views/partials/header.php'); ?>
<?php include('views/partials/navbar.php'); ?>
<div class="container py-5">
    <h2 class="mb-4">Nueva Categoría</h2>

    <form method="POST" class="row g-3">
        <div class="col-md-6">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="descripcion" class="form-label">Descripción:</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" required>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="categorias.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
