<?php include('views/partials/header.php'); ?>
<?php include('views/partials/navbar.php'); ?>

<?php
require_once('controllers/ProductosController.php');
$controller = new ProductosController();
$controller->mostrarProductos();
?>

<?php include('views/partials/footer.php'); ?>
