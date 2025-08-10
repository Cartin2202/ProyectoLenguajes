<?php
require_once __DIR__ . '/../models/EmpleadosModel.php';

class EmpleadosController
{
    private $model;

    public function __construct()
    {
        $this->model = new EmpleadosModel();
    }

    public function index()
    {
        $empleados = $this->model->listarEmpleados();
        include 'views/empleados_view.php';
    }

    // ✅ Método agregado para que funcione empleados.php
    public function listarEmpleados()
    {
        return $this->model->listarEmpleados();
    }

    public function registrarEmpleado($datos)
    {
        // Convertir la fecha al formato YYYY-MM-DD (lo espera el TO_TIMESTAMP)
        $datos['fecha'] = date('Y-m-d', strtotime($datos['fecha']));
        $this->model->insertarEmpleado($datos);
    }


    public function actualizarEmpleado($datos)
    {
        $datos['fecha'] = date('Y-m-d', strtotime($datos['fecha']));
        $this->model->actualizarEmpleado($datos);
    }



    public function eliminarEmpleado($cedula)
    {
        $this->model->eliminarEmpleado($cedula);
    }

    public function obtenerEmpleado($cedula)
    {
        return $this->model->obtenerEmpleadoPorCedula($cedula);
    }

    public function listarPuestos()
    {
        return $this->model->listarPuestos();
    }

    public function listarRoles()
    {
        return $this->model->listarRoles();
    }
}
