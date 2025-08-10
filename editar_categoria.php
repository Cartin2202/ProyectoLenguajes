<?php
require_once 'models/CategoriasModel.php';

$model = new CategoriasModel();

// Validar que venga el ID
if (!isset($_GET['id'])) {
    header('Location: categorias.php');
    exit();
}

$id = $_GET['id'];
$categoria = $model->obtenerCategoriaPorId($id);

if (!$categoria) {
    echo "<div class='alert alert-danger'>Categoría no encontrada.</div>";
    exit();
}

// Al enviar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];

    $model->actualizarCategoria($id, $nombre, $descripcion, $estado);
    header('Location: categorias.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<?php include('views/partials/header.php'); ?>
<?php include('views/partials/navbar.php'); ?>
<div class="container py-5">
    <h2 class="mb-4">Editar Categoría</h2>

    <form method="POST" class="row g-3">
        <div class="col-md-6">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="<?= htmlspecialchars($categoria['NOMBRE']) ?>" required>
        </div>

        <div class="col-md-6">
            <label for="descripcion" class="form-label">Descripción:</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" value="<?= htmlspecialchars($categoria['DESCRIPCION']) ?>" required>
        </div>

        <div class="col-md-4">
            <label for="estado" class="form-label">Estado:</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="1" <?= $categoria['ID_ESTADO'] == 1 ? 'selected' : '' ?>>Activo</option>
                <option value="2" <?= $categoria['ID_ESTADO'] == 2 ? 'selected' : '' ?>>Inactivo</option>
            </select>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="categorias.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
