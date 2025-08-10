<?php
require_once __DIR__ . '/../config/conexion.php';

class VentasController
{
    private $conn;
    public function __construct()
    {
        $conexion = new Conexion();
        $this->conn = $conexion->getConexion();
    }

    # ------- LISTADOS -------
    public function listarVentas()
    {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_VENTAS_TB_LISTAR_SP(:c); END;");
        $c = oci_new_cursor($this->conn);
        oci_bind_by_name($stmt, ":c", $c, -1, OCI_B_CURSOR);
        oci_execute($stmt);
        oci_execute($c);
        $out = [];
        while ($r = oci_fetch_assoc($c)) $out[] = $r;
        oci_free_statement($stmt);
        oci_free_statement($c);
        return $out;
    }

    public function listarDetalleVenta($ventaId)
    {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_DETALLE_VENTAS_TB_LISTAR_POR_VENTA_SP(:id,:c); END;");
        $c = oci_new_cursor($this->conn);
        oci_bind_by_name($stmt, ":id", $ventaId);
        oci_bind_by_name($stmt, ":c", $c, -1, OCI_B_CURSOR);
        oci_execute($stmt);
        oci_execute($c);
        $out = [];
        while ($r = oci_fetch_assoc($c)) $out[] = $r;
        oci_free_statement($stmt);
        oci_free_statement($c);
        return $out;
    }

    public function obtenerVenta($ventaId)
    {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_VENTAS_TB_OBTENER_SP(:id,:c); END;");
        $c = oci_new_cursor($this->conn);
        oci_bind_by_name($stmt, ":id", $ventaId);
        oci_bind_by_name($stmt, ":c", $c, -1, OCI_B_CURSOR);
        oci_execute($stmt);
        oci_execute($c);
        $row = oci_fetch_assoc($c) ?: null;
        oci_free_statement($stmt);
        oci_free_statement($c);
        return $row;
    }

    # ------- UTILIDADES (combos/soporte) -------
    public function listarClientes()
    {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_USUARIOS_TB_LISTAR_CLIENTES_SP(:c); END;");
        $c = oci_new_cursor($this->conn);
        oci_bind_by_name($stmt, ":c", $c, -1, OCI_B_CURSOR);
        oci_execute($stmt);
        oci_execute($c);
        $out = [];
        while ($r = oci_fetch_assoc($c)) $out[] = $r;
        oci_free_statement($stmt);
        oci_free_statement($c);
        return $out;
    }

    public function listarMetodosPago()
    {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_METODO_PAGO_TB_LISTAR_SP(:c); END;");
        $c = oci_new_cursor($this->conn);
        oci_bind_by_name($stmt, ":c", $c, -1, OCI_B_CURSOR);
        oci_execute($stmt);
        oci_execute($c);
        $out = [];
        while ($r = oci_fetch_assoc($c)) $out[] = $r;
        oci_free_statement($stmt);
        oci_free_statement($c);
        return $out;
    }

    # ------- FACTURA TXT -------
    // controllers/VentasController.php
    public function generarFacturaTxt($ventaId)
    {
        $venta   = $this->obtenerVenta($ventaId);
        $detalle = $this->listarDetalleVenta($ventaId);
        if (!$venta) throw new Exception("Venta $ventaId no encontrada.");

        $lines = [];
        $lines[] = "Piedras & Enchapes";
        $lines[] = "FACTURA";
        $lines[] = "Venta: {$venta['ID_VENTA']}";
        $lines[] = "Fecha: " . ($venta['FECHA'] ?? date('Y-m-d H:i:s'));
        $lines[] = "Cliente ID: " . ($venta['ID_CLIENTE'] ?? 'N/A');
        $lines[] = str_repeat('-', 40);
        $total = 0;
        foreach ($detalle as $d) {
            $sub = $d['PRECIO_UNITARIO'] * $d['CANTIDAD'];
            $total += $sub;
            $nombre = $d['NOMBRE_PRODUCTO'] ?? ("PROD " . $d['ID_PRODUCTO']);
            $lines[] = sprintf("%s  x%d  = %.2f", $nombre, $d['CANTIDAD'], $sub);
        }
        $lines[] = str_repeat('-', 40);
        $lines[] = sprintf("TOTAL: %.2f", $total);

        // Guardar en carpeta del proyecto: /facturas_txt
        $dir = dirname(__DIR__) . '/facturas_txt'; // sube desde /controllers a raíz del proyecto
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $file = $dir . '/factura_' . date('Ymd_His') . "_venta_{$ventaId}.txt";
        file_put_contents($file, implode(PHP_EOL, $lines));

        return $file; // ruta absoluta del archivo por si la quieres loguear
    }

    public function crearVenta($cedulaCliente)
    {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_VENTAS_TB_INSERTAR_SP(:total,:ced); END;");
        $zero = 0;
        oci_bind_by_name($stmt, ":total", $zero);
        oci_bind_by_name($stmt, ":ced", $cedulaCliente);
        oci_execute($stmt);

        // obtener id_venta recién creado
        $q = oci_parse($this->conn, "
    SELECT id_venta FROM FIDE_VENTAS_TB 
     WHERE cedula=:ced ORDER BY fecha_venta DESC FETCH FIRST 1 ROW ONLY");
        oci_bind_by_name($q, ":ced", $cedulaCliente);
        oci_execute($q);
        $row = oci_fetch_assoc($q);
        return $row ? $row['ID_VENTA'] : null;
    }

    public function agregarItem($idVenta, $idProd, $cant)
    {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_DETALLE_VENTAS_TB_INSERTAR_SP(:v,:p,:c); END;");
        oci_bind_by_name($stmt, ":v", $idVenta);
        oci_bind_by_name($stmt, ":p", $idProd);
        oci_bind_by_name($stmt, ":c", $cant);
        return oci_execute($stmt);
    }

    public function cerrarVenta($idVenta, $idMetodoPago, $cedulaCliente)
    {
        // factura
        $f = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_FACTURAS_TB_INSERTAR_SP(:v,:ced); END;");
        oci_bind_by_name($f, ":v", $idVenta);
        oci_bind_by_name($f, ":ced", $cedulaCliente);
        oci_execute($f);

        // obtener id_factura
        $q = oci_parse($this->conn, "
    SELECT id_factura FROM FIDE_FACTURAS_TB 
     WHERE id_venta=:v AND cedula=:ced ORDER BY fecha_emision DESC FETCH FIRST 1 ROW ONLY");
        oci_bind_by_name($q, ":v", $idVenta);
        oci_bind_by_name($q, ":ced", $cedulaCliente);
        oci_execute($q);
        $row = oci_fetch_assoc($q);
        $idFactura = $row['ID_FACTURA'];

        // pago
        $p = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_PAGOS_TB_INSERTAR_SP(:met,:fac); END;");
        oci_bind_by_name($p, ":met", $idMetodoPago);
        oci_bind_by_name($p, ":fac", $idFactura);
        oci_execute($p);

        return $idFactura;
    }

    public function registrarVenta(int $cedulaCliente, int $idMetodoPago, array $items)
    {
        if (empty($items)) {
            throw new Exception('No hay items para registrar.');
        }

        // 1) Cabecera
        $idVenta = $this->crearVenta($cedulaCliente);
        if (!$idVenta) {
            throw new Exception('No se pudo crear la venta.');
        }

        // 2) Detalle (usa trigger para precio y suma al total)
        foreach ($items as $it) {
            // Espera keys: id, cantidad  (precio/nombre no son necesarios para la BD)
            $idProd = (int)($it['id'] ?? 0);
            $cant   = (int)($it['cantidad'] ?? 0);
            if ($idProd > 0 && $cant > 0) {
                $ok = $this->agregarItem($idVenta, $idProd, $cant);
                if (!$ok) {
                    throw new Exception("No se pudo agregar el producto $idProd.");
                }
            }
        }

        // 3) Factura y pago (el trigger rellena subtotal/IVA/total y datos del pago)
        $idFactura = $this->cerrarVenta($idVenta, $idMetodoPago, $cedulaCliente);

        // Devolvemos el ID de la venta porque tu CarritoController lo usa para generar el TXT
        return $idVenta;
    }
}
