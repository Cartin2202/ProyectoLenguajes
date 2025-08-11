<?php
require_once __DIR__ . '/../models/ClientesModel.php';

class ClientesController
{
    private $model;

    public function __construct()
    {
        $this->model = new ClientesModel();
    }

    // metodo agregado para que funcione empleados.php
    public function registrarClientes($datos) {
        $this->model->insertarClientes(
            $datos['cedula'],
            $datos['nombre'],
            $datos['apellido1'],
            $datos['apellido2'],
            $datos['usuario'],
            $datos['pass'],
            $datos['correo'],
            $datos['fecha']
        );

        header("Location: insertar_clientes.php");
    }

    public function actualizarClientes($datos) {
        $this->model->actualizarClientes(
            $datos['cedula'],
            $datos['nombre'],
            $datos['apellido1'],
            $datos['apellido2'],
            $datos['usuario'],
            $datos['pass'],
            $datos['correo'],
            $datos['fecha'],
            $datos['estado']
        );
        header("Location: editar_clientes.php");
    }

    public function obtenerClientes() {
        return $this->model->obtenerClientes();
    }

    public function obtenerClientesPorCedula($cedula) {
        return $this->model->obtenerClientesPorCedula($cedula);
        
    }
    // detalle de las vventas
    public function obtenerVentasPorCliente($cedula) {
        return $this->model->obtenerVentasPorCliente($cedula);
    }

    public function eliminarClientes($cedula) {
        $this->model->eliminarClientes(
            $cedula['cedula']
        );
        header("Location: eliminar_clientes.php");
    }
    
}
