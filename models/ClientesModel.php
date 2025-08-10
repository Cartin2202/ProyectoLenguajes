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
        $stmt = oci_parse($this->conn, "SELECT cedula, nombre, primer_apellido,
            segundo_apellido, nombre_usuario, correo, fecha_nacimiento, id_estado
            FROM FIDE_USUARIOS_TB
            WHERE id_estado != 2
            AND id_tipo_usuario = 2" 
        );
        oci_execute($stmt);

        $clientes = [];
        while ($row = oci_fetch_assoc($stmt)) {
            $clientes[] = $row;
        }
        oci_free_statement($stmt);
        return $clientes;
    }


    public function obtenerClientesPorCedula($cedula) {
    $sql = "SELECT u.cedula, u.nombre, u.primer_apellido, u.segundo_apellido,
            u.nombre_usuario, u.correo, TO_CHAR(u.fecha_nacimiento, 'YYYY-MM-DD') AS fecha_nacimiento,
            p.nombre_provincia,
            c.nombre_canton,
            dis.nombre_distrito,
            d.detalle_direccion,
            t.telefono

            FROM FIDE_USUARIOS_TB u
            LEFT JOIN FIDE_DIRECCIONES_TB d 
            ON u.cedula = d.cedula
            LEFT JOIN FIDE_PROVINCIAS_TB p 
            ON d.id_provincia_direccion = p.id_provincia
            LEFT JOIN FIDE_CANTONES_TB c 
            ON d.id_canton_direccion = c.id_canton
            LEFT JOIN FIDE_DISTRITOS_TB dis 
            ON d.id_distrito_direccion = dis.id_distrito
            LEFT JOIN FIDE_TELEFONOS_TB t 
            ON u.cedula = t.cedula

            WHERE u.id_estado != 2
            AND u.cedula = :cedula";

        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ":cedula", $cedula);

        oci_execute($stmt);
        $cliente = oci_fetch_assoc($stmt); 
        oci_free_statement($stmt);

        return $cliente;  
    }

    public function obtenerVentas($cedula) {
        $sql = "SELECT id_venta, TO_CHAR(fecha_venta, 'YYYY-MM-DD HH24:MI:SS') AS fecha, total
                FROM FIDE_VENTAS_TB
                WHERE cedula = :cedula";

        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':cedula', $cedula);
        oci_execute($stmt);

        $ventas = [];
        while ($row = oci_fetch_assoc($stmt)) {
            $ventas[] = $row;
        }
        oci_free_statement($stmt);
        return $ventas;
    }

    public function actualizarClientes($cedula, $nombre, $apellido1, $apellido2, $usuario, $pass, $correo, $fecha, $estado) {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_USUARIOS_TB_ACTUALIZAR_USUARIO_CLIENTE_SP(
            :cedula,
            :nombre,
            :apellido1,
            :apellido2,
            :usuario,
            :pass,
            :correo,
            TO_TIMESTAMP(:fecha, 'YYYY-MM-DD'),
            :estado
        ); END;");

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


    // Ventas de Clientes
    public function obtenerVentasPorCliente($cedula) {
        $sql = "SELECT TO_CHAR(v.fecha_venta, 'YYYY-MM-DD') AS fecha,
        p.nombre,
        dv.cantidad,
        dv.precio_unitario,
        (dv.cantidad * dv.precio_unitario) AS subtotal
        FROM FIDE_VENTAS_TB v
        JOIN FIDE_DETALLE_VENTAS_TB dv
        ON v.id_venta = dv.id_venta
        JOIN FIDE_PRODUCTO_TB p
        ON dv.id_producto = p.id_producto
        WHERE v.cedula = :cedula";

        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':cedula', $cedula);
        oci_execute($stmt);

        $ventas = [];
        while ($row = oci_fetch_assoc($stmt)) {
            $ventas[] = $row;
        }
        oci_free_statement($stmt);
        return $ventas;
    }
}
