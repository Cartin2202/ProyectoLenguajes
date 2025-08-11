<?php
require_once __DIR__ . '/../models/CarritoModel.php';
require_once __DIR__ . '/VentasController.php'; 

class CarritoController
{
    private $carrito;
    private $ventas;

    public function __construct()
    {
        $this->carrito = new CarritoModel();
        $this->ventas  = new VentasController();
    }

    public function agregar($id, $nombre, $precio, $cantidad)
    {
        $this->carrito->agregar($id, $nombre, $precio, $cantidad);
    }

    public function eliminar($id)
    {
        $this->carrito->eliminar($id);
    }

    public function vaciar()
    {
        $this->carrito->vaciar();
    }

    public function actualizar($cantidades)
    {
        $this->carrito->actualizarCantidades($cantidades);
    }

    public function obtenerDatosVista()
    {
        return [
            'carrito' => $this->carrito->obtenerCarrito(),
            'total'   => $this->carrito->totalCarrito(),
            'clientes' => $this->ventas->listarClientes(),    
            'metodos' => $this->ventas->listarMetodosPago(),  
        ];
    }

    public function checkout($clienteId, $metodoPago)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $items = $this->carrito->obtenerCarrito();
        if (empty($items)) throw new Exception('Carrito vacío.');

        $ventaId = $this->ventas->registrarVenta((int)$clienteId, (int)$metodoPago, $items);

        // guarda y genera el txt de la factura
        $fileAbsPath = $this->ventas->generarFacturaTxt($ventaId);

        $this->carrito->vaciar();

        //mensaje que redirige 
        $_SESSION['flash_success'] = 'Factura generada y guardada en el sistema.';
        
        return null;
    }
}
