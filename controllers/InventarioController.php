<?php
require_once __DIR__ . '/../config/conexion.php';

class InventarioController
{
    private $conn;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->conn = $conexion->getConexion();
    }

    // vista inventario
    public function mostrarReporte()
    {
        include __DIR__ . '/../views/inventario_view.php';
    }

    
    public function insertarMovimiento($tipo, $motivo)
    {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_MOVIMIENTO_INVENTARIO_TB_INSERTAR_SP(:tipo, :motivo); END;");
        oci_bind_by_name($stmt, ":tipo", $tipo);
        oci_bind_by_name($stmt, ":motivo", $motivo);
        oci_execute($stmt);
    }

    public function insertarMovimientoProducto($id_movimiento, $id_producto, $cantidad)
    {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_MOVIMIENTO_PRODUCTO_TB_INSERTAR_SP(:mov, :prod, :cant); END;");
        oci_bind_by_name($stmt, ":mov", $id_movimiento);
        oci_bind_by_name($stmt, ":prod", $id_producto);
        oci_bind_by_name($stmt, ":cant", $cantidad);
        oci_execute($stmt);
    }

    public function asociarProducto($id_movimiento, $id_producto, $cantidad)
    {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_MOVIMIENTO_PRODUCTO_TB_INSERTAR_SP(:mov, :prod, :cant); END;");
        oci_bind_by_name($stmt, ":mov", $id_movimiento);
        oci_bind_by_name($stmt, ":prod", $id_producto);
        oci_bind_by_name($stmt, ":cant", $cantidad);
        oci_execute($stmt);
    }

    public function actualizarMovimiento($id_movimiento, $id_tipo, $id_motivo)
    {
        $fecha_movimiento = date('d/m/Y H:i:s'); 
        $id_estado = 1; 

        $stmt = oci_parse($this->conn, "
        BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_MOVIMIENTO_INVENTARIO_TB_ACTUALIZAR_SP(
            :id_mov, 
            TO_TIMESTAMP(:fecha, 'DD/MM/YYYY HH24:MI:SS'), 
            :id_tipo, 
            :id_motivo, 
            :id_estado
        ); END;");

        oci_bind_by_name($stmt, ":id_mov", $id_movimiento);
        oci_bind_by_name($stmt, ":fecha", $fecha_movimiento);
        oci_bind_by_name($stmt, ":id_tipo", $id_tipo);
        oci_bind_by_name($stmt, ":id_motivo", $id_motivo);
        oci_bind_by_name($stmt, ":id_estado", $id_estado);

        oci_execute($stmt);
    }


    public function eliminarMovimiento($id_movimiento)
    {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_MOVIMIENTO_INVENTARIO_TB_ELIMINAR_SP(:id); END;");
        oci_bind_by_name($stmt, ":id", $id_movimiento);
        oci_execute($stmt);
    }

    public function listarMovimientos()
    {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_MOVIMIENTO_INVENTARIO_TB_CONSULTAR_SP(:cursor); END;");
        $cursor = oci_new_cursor($this->conn);
        oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($cursor);

        $movimientos = [];
        while (($row = oci_fetch_assoc($cursor)) != false) {
            $movimientos[] = $row;
        }
        return $movimientos;
    }

    public function obtenerMotivos()
{
    $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_MOTIVO_MOVIMIENTO_TB_LISTAR_SP(:cursor); END;");
    $cursor = oci_new_cursor($this->conn);
    oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);

    oci_execute($stmt);
    oci_execute($cursor);

    $motivos = [];
    while (($row = oci_fetch_assoc($cursor)) != false) {
        $motivos[] = $row;
    }

    return $motivos;
}

public function obtenerTiposMovimiento()
{
    $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_TIPO_MOVIMIENTO_TB_LISTAR_SP(:cursor); END;");
    $cursor = oci_new_cursor($this->conn);
    oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);

    oci_execute($stmt);
    oci_execute($cursor);

    $tipos = [];
    while (($row = oci_fetch_assoc($cursor)) != false) {
        $tipos[] = $row;
    }

    return $tipos;
}
}
