<?php
class CarritoModel {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['carrito'])) $_SESSION['carrito'] = []; 
    }

    public function obtenerCarrito() {
        return $_SESSION['carrito'];
    }

    public function totalCarrito() {
        $t = 0;
        foreach ($_SESSION['carrito'] as $it) {
            $t += $it['precio'] * $it['cantidad'];
        }
        return $t;
    }

    public function agregar($id, $nombre, $precio, $cantidad = 1) {
        if (isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id]['cantidad'] += $cantidad;
        } else {
            $_SESSION['carrito'][$id] = [
                'id' => (int)$id,
                'nombre' => $nombre,
                'precio' => (float)$precio,
                'cantidad' => (int)$cantidad
            ];
        }
    }

    public function actualizarCantidades($nuevos) {
        $nuevo = [];
        foreach ($nuevos as $id => $cant) {
            $id = (int)$id;
            $cant = max(1, (int)$cant);
            if (isset($_SESSION['carrito'][$id])) {
                $nuevo[$id] = $_SESSION['carrito'][$id];
                $nuevo[$id]['cantidad'] = $cant;
            }
        }
        $_SESSION['carrito'] = $nuevo;
    }

    public function eliminar($id) {
        unset($_SESSION['carrito'][(int)$id]);
    }

    public function vaciar() {
        $_SESSION['carrito'] = [];
    }
}
