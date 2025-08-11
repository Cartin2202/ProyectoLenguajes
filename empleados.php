<?php
require_once 'controllers/EmpleadosController.php';

$controller = new EmpleadosController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_GET['accion'] ?? '';   // <-- aquí cambiamos a 'accion'

    switch ($accion) {
        case 'registrar':
            $controller->registrarEmpleado($_POST);
            break;

        case 'actualizar':
            $controller->actualizarEmpleado($_POST);
            break;

        case 'eliminar':
            $cedula = $_POST['cedula'] ?? null;
            if ($cedula) {
                $controller->eliminarEmpleado($cedula);
            }
            break;
    }

    header("Location: empleados.php");
    exit();
}

// Si no es POST, carga la vista correspondiente
$accion = $_GET['accion'] ?? 'consultar';

switch ($accion) {
    case 'registrar':
        include 'registrar_empleado.php';
        break;

    case 'actualizar':
        include 'actualizar_empleado.php';
        break;

    case 'eliminar':
        include 'eliminar_empleado.php';
        break;

    case 'consultar':
    default:
        $empleados = $controller->listarEmpleados();
        include 'views/empleados_view.php';
        break;
}
