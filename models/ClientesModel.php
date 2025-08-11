<?php
require_once __DIR__ . '/../config/conexion.php';

class ClientesModel
{
    private $conn;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->conn = $conexion->getConexion();
    }

    public function insertarClientes($cedula, $nombre, $apellido1, $apellido2, $usuario, $pass, $correo, $fecha) {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_USUARIOS_TB_INSERTAR_USUARIO_CLIENTE_SP(
            :cedula, :nombre, :apellido1, :apellido2,:usuario, :pass,:correo,TO_TIMESTAMP(:fecha, 'YYYY-MM-DD')); END;");

        oci_bind_by_name($stmt, ":cedula", $cedula);
        oci_bind_by_name($stmt, ":nombre", $nombre);
        oci_bind_by_name($stmt, ":apellido1", $apellido1);
        oci_bind_by_name($stmt, ":apellido2", $apellido2);
        oci_bind_by_name($stmt, ":usuario", $usuario);
        oci_bind_by_name($stmt, ":pass", $pass);
        oci_bind_by_name($stmt, ":correo", $correo);
        oci_bind_by_name($stmt, ":fecha", $fecha);
        oci_execute($stmt);
        oci_commit($this->conn);
        oci_free_statement($stmt);
    }

    public function obtenerClientes() {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_LISTAR_CLIENTES_SP(:cursor); END;");
        $cursor = oci_new_cursor($this->conn);
        
        oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($cursor);

        $clientes = [];
        while ($row = oci_fetch_assoc($cursor)) {
            $clientes[] = $row;
        }
        oci_free_statement($stmt);
        oci_free_statement($cursor);
        return $clientes;
    }

    public function obtenerClientesPorCedula($cedula) {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_OBTENER_CLIENTE_POR_CEDULA_SP(:cedula, :cursor); END;");
        $cursor = oci_new_cursor($this->conn);
        
        oci_bind_by_name($stmt, ":cedula", $cedula);
        oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);
        
        oci_execute($stmt);
        oci_execute($cursor);

        $cliente = oci_fetch_assoc($cursor);

        oci_free_statement($stmt);
        oci_free_statement($cursor);

        return $cliente;
    }

    public function obtenerVentas($cedula) {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_OBTENER_VENTAS_SP(:cedula, :cursor); END;");
        $cursor = oci_new_cursor($this->conn);
        
        oci_bind_by_name($stmt, ":cedula", $cedula);
        oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($cursor);

        $ventas = [];
        while ($row = oci_fetch_assoc($cursor)) {
            $ventas[] = $row;
        }

        oci_free_statement($stmt);
        oci_free_statement($cursor);

        return $ventas;
    }

    public function obtenerVentasPorCliente($cedula) {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_OBTENER_VENTAS_POR_CLIENTE_SP(:cedula, :cursor); END;");
        $cursor = oci_new_cursor($this->conn);

        oci_bind_by_name($stmt, ":cedula", $cedula);
        oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($cursor);

        $ventas = [];
        while ($row = oci_fetch_assoc($cursor)) {
            $ventas[] = $row;
        }

        oci_free_statement($stmt);
        oci_free_statement($cursor);

        return $ventas;
    }


    public function actualizarClientes($cedula, $nombre, $apellido1, $apellido2, $usuario, $pass, $correo, $fecha, $estado) {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_USUARIOS_TB_ACTUALIZAR_USUARIO_CLIENTE_SP(
            :cedula, :nombre,:apellido1, :apellido2, :usuario, :pass, :correo, TO_TIMESTAMP(:fecha, 'YYYY-MM-DD'),:estado); 
            END;");

        oci_bind_by_name($stmt, ":cedula", $cedula);
        oci_bind_by_name($stmt, ":nombre", $nombre);
        oci_bind_by_name($stmt, ":apellido1", $apellido1);
        oci_bind_by_name($stmt, ":apellido2", $apellido2);
        oci_bind_by_name($stmt, ":usuario", $usuario);
        oci_bind_by_name($stmt, ":pass", $pass);
        oci_bind_by_name($stmt, ":correo", $correo);
        oci_bind_by_name($stmt, ":fecha", $fecha);
        oci_bind_by_name($stmt, ":estado", $estado);
        oci_execute($stmt);
        oci_commit($this->conn);
        oci_free_statement($stmt);
    }

    public function eliminarClientes($cedula) {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_USUARIOS_TB_ELIMINAR_USUARIO_SP(:cedula); END;");

        oci_bind_by_name($stmt, ":cedula", $cedula);
        oci_execute($stmt);
        oci_commit($this->conn);
        oci_free_statement($stmt);
    }

}
