<?php
require_once 'controllers/EmpleadosController.php';

$controller = new EmpleadosController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'] ?? '';

    switch ($action) {
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

    // Redirigir después de acción POST para evitar reenviar formulario al recargar
    header("Location: empleados.php");
    exit();
}

// Si no es POST, carga la vista correspondiente
$action = $_GET['accion'] ?? 'consultar';

switch ($action) {
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
