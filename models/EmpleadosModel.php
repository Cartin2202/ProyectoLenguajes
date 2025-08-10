<?php
require_once __DIR__ . '/../config/conexion.php';

class EmpleadosModel
{
    private $conn;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->conn = $conexion->getConexion();
    }

    public function listarEmpleados()
    {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_USUARIOS_TB_CONSULTAR_SP(:cursor); END;");
        $cursor = oci_new_cursor($this->conn);
        oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);
        oci_execute($stmt);
        oci_execute($cursor);

        $empleados = [];
        while ($row = oci_fetch_assoc($cursor)) {
            $empleados[] = $row;
        }

        oci_free_statement($stmt);
        oci_free_statement($cursor);
        return $empleados;
    }

    public function insertarEmpleado($data)
    {
        $sql = "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_USUARIOS_TB_INSERTAR_USUARIO_EMPLEADO_SP(
                :cedula, :nombre, :apellido1, :apellido2,
                :usuario, :pass, :correo,
                TO_TIMESTAMP(:fecha, 'YYYY-MM-DD'),
                :salario, :puesto, :rol
            ); END;";

        $stmt = oci_parse($this->conn, $sql);

        oci_bind_by_name($stmt, ":cedula", $data['cedula']);
        oci_bind_by_name($stmt, ":nombre", $data['nombre']);
        oci_bind_by_name($stmt, ":apellido1", $data['apellido1']);
        oci_bind_by_name($stmt, ":apellido2", $data['apellido2']);
        oci_bind_by_name($stmt, ":usuario", $data['usuario']);
        oci_bind_by_name($stmt, ":pass", $data['pass']);
        oci_bind_by_name($stmt, ":correo", $data['correo']);
        oci_bind_by_name($stmt, ":fecha", $data['fecha']);
        oci_bind_by_name($stmt, ":salario", $data['salario']);
        oci_bind_by_name($stmt, ":puesto", $data['puesto']);
        oci_bind_by_name($stmt, ":rol", $data['rol']);

        if (!oci_execute($stmt)) {
            $e = oci_error($stmt);
            throw new Exception("Error al registrar empleado: " . $e['message']);
        }

        oci_free_statement($stmt);
    }

    public function actualizarEmpleado($data)
    {
        $stmt = oci_parse($this->conn, "
        BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_USUARIOS_TB_ACTUALIZAR_USUARIO_EMPLEADO_SP(
            :cedula, :nombre, :ap1, :ap2, :usuario, :pass, :correo,
            TO_TIMESTAMP(:fecha, 'YYYY-MM-DD'), :salario, :puesto, :rol, :estado
        ); 
        END;
    ");

        oci_bind_by_name($stmt, ":cedula", $data['cedula']);
        oci_bind_by_name($stmt, ":nombre", $data['nombre']);
        oci_bind_by_name($stmt, ":ap1", $data['apellido1']);
        oci_bind_by_name($stmt, ":ap2", $data['apellido2']);
        oci_bind_by_name($stmt, ":usuario", $data['usuario']);
        oci_bind_by_name($stmt, ":pass", $data['pass']);
        oci_bind_by_name($stmt, ":correo", $data['correo']);
        oci_bind_by_name($stmt, ":fecha", $data['fecha']);
        oci_bind_by_name($stmt, ":salario", $data['salario']);
        oci_bind_by_name($stmt, ":puesto", $data['puesto']);
        oci_bind_by_name($stmt, ":rol", $data['rol']);
        oci_bind_by_name($stmt, ":estado", $data['estado']);

        oci_execute($stmt);
        oci_commit($this->conn);
        oci_free_statement($stmt);
    }

    public function eliminarEmpleado($cedula)
    {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_USUARIOS_TB_ELIMINAR_USUARIO_SP(:cedula); END;");
        oci_bind_by_name($stmt, ":cedula", $cedula);
        oci_execute($stmt);
        oci_commit($this->conn);
        oci_free_statement($stmt);
    }

    public function obtenerEmpleadoPorCedula($cedula)
    {
        $stmt = oci_parse($this->conn, "
            BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_USUARIOS_TB_OBTENER_USUARIO_POR_CEDULA_SP(:cedula, :cursor); 
            END;
        ");

        $cursor = oci_new_cursor($this->conn);
        oci_bind_by_name($stmt, ":cedula", $cedula);
        oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($cursor);

        $empleado = oci_fetch_assoc($cursor);

        oci_free_statement($stmt);
        oci_free_statement($cursor);

        return $empleado;
    }

    public function listarPuestos()
    {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_PUESTO_TB_LISTAR_SP(:cursor); END;");
        $cursor = oci_new_cursor($this->conn);
        oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($cursor);

        $puestos = [];
        while ($row = oci_fetch_assoc($cursor)) {
            $puestos[] = $row;
        }

        oci_free_statement($stmt);
        oci_free_statement($cursor);
        return $puestos;
    }

    public function listarRoles()
    {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_ROL_TB_LISTAR_SP(:cursor); END;");
        $cursor = oci_new_cursor($this->conn);
        oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($cursor);

        $roles = [];
        while ($row = oci_fetch_assoc($cursor)) {
            $roles[] = $row;
        }

        oci_free_statement($stmt);
        oci_free_statement($cursor);
        return $roles;
    }
}
