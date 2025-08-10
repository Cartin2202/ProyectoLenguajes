<?php
require_once __DIR__ . '/../config/conexion.php';

class InventarioModel {

    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->getConexion();
    }

    public function obtenerMovimientos($tipo = null, $fechaInicio = null, $fechaFin = null, $categoria = null) {
        $stmt = oci_parse($this->conn, "
            BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_MOVIMIENTOS_TB_FILTRADOS_SP(
                :cursor, :tipo, TO_DATE(:fechaInicio, 'YYYY-MM-DD'), TO_DATE(:fechaFin, 'YYYY-MM-DD'), :categoria
            ); END;
        ");

        $cursor = oci_new_cursor($this->conn);

        oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);
        oci_bind_by_name($stmt, ":tipo", $tipo);
        oci_bind_by_name($stmt, ":fechaInicio", $fechaInicio);
        oci_bind_by_name($stmt, ":fechaFin", $fechaFin);
        oci_bind_by_name($stmt, ":categoria", $categoria);

        oci_execute($stmt);
        oci_execute($cursor);

        $movimientos = [];
        while ($row = oci_fetch_assoc($cursor)) {
            $movimientos[] = $row;
        }

        return $movimientos;
    }
}
?>
