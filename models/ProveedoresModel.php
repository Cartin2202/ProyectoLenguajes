<?php
require_once __DIR__ . '/../config/conexion.php';

class ProveedoresModel
{
    private $conn;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->conn = $conexion->getConexion();
    }

    public function listarProveedores()
    {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_PROVEEDOR_TB_CONSULTAR_SP(:cursor); END;");
        $cursor = oci_new_cursor($this->conn);
        oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);
        oci_execute($stmt);
        oci_execute($cursor);

        $proveedores = [];
        while ($row = oci_fetch_assoc($cursor)) {
            $proveedores[] = $row;
        }

        oci_free_statement($stmt);
        oci_free_statement($cursor);
        return $proveedores;
    }

    public function insertarProveedor($empresa, $correo)
    {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_PROVEEDOR_TB_INSERTAR_PROVEEDOR_SP(:empresa, :correo); END;");
        oci_bind_by_name($stmt, ":empresa", $empresa);
        oci_bind_by_name($stmt, ":correo", $correo);
        oci_execute($stmt);
        oci_commit($this->conn);
        oci_free_statement($stmt);
    }

    public function actualizarProveedor($id, $empresa, $correo)
    {
        $fechaRegistro = date('Y-m-d'); 
        $idEstado = 1; 

        $stmt = oci_parse($this->conn, "
        BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_PROVEEDOR_TB_ACTUALIZAR_PROVEEDOR_SP(
            :id, :empresa, :correo, TO_DATE(:fecha, 'YYYY-MM-DD'), :estado
        ); 
        END;
    ");

        oci_bind_by_name($stmt, ":id", $id);
        oci_bind_by_name($stmt, ":empresa", $empresa);
        oci_bind_by_name($stmt, ":correo", $correo);
        oci_bind_by_name($stmt, ":fecha", $fechaRegistro);
        oci_bind_by_name($stmt, ":estado", $idEstado);

        oci_execute($stmt);
        oci_commit($this->conn);
        oci_free_statement($stmt);
    }


    public function eliminarProveedor($id)
    {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_PROVEEDOR_TB_ELIMINAR_PROVEEDOR_SP(:id); END;");
        oci_bind_by_name($stmt, ":id", $id);
        oci_execute($stmt);
        oci_commit($this->conn);
        oci_free_statement($stmt);
    }

    public function asociarProducto($idProveedor, $idProducto, $precioCompra)
    {
        $stmt = oci_parse($this->conn, "
        BEGIN 
            FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_PROVEEDOR_PRODUCTO_TB_INSERTAR_SP(
                :prov, :prod, :precio
            ); 
        END;
    ");

        oci_bind_by_name($stmt, ":prov", $idProveedor);
        oci_bind_by_name($stmt, ":prod", $idProducto);
        oci_bind_by_name($stmt, ":precio", $precioCompra);
        oci_execute($stmt);
        oci_commit($this->conn);
        oci_free_statement($stmt);
    }
}
