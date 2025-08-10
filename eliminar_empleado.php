<?php
require_once 'controllers/EmpleadosController.php';
include('views/partials/header.php');
include('views/partials/navbar.php');

if (!isset($_GET['cedula'])) {
    header("Location: empleados.php");
    exit;
}

$cedula = $_GET['cedula'];

$controller = new EmpleadosController();
$controller->eliminarEmpleado($cedula);

// Redirige al listado
header("Location: empleados.php");
exit;
