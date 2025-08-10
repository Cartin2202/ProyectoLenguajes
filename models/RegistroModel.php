<?php
require_once __DIR__ . '/../config/conexion.php';

class RegistroModel
{
    private $conn;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->conn = $conexion->getConexion();
    }

    public function insertarUsuarioCliente($datos)
    {
        $stmt = oci_parse($this->conn, "
        BEGIN 
            FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_USUARIOS_TB_INSERTAR_USUARIO_CLIENTE_SP(
                :cedula, :nombre, :apellido1, :apellido2,
                :usuario, :contrasena, :correo,
                TO_TIMESTAMP(:fecha, 'YYYY-MM-DD')
            );
        END;
    ");

        oci_bind_by_name($stmt, ":cedula", $datos['cedula']);
        oci_bind_by_name($stmt, ":nombre", $datos['nombre']);
        oci_bind_by_name($stmt, ":apellido1", $datos['primer_apellido']);
        oci_bind_by_name($stmt, ":apellido2", $datos['segundo_apellido']);
        oci_bind_by_name($stmt, ":usuario", $datos['nombre_usuario']);
        oci_bind_by_name($stmt, ":contrasena", $datos['contrasena']);
        oci_bind_by_name($stmt, ":correo", $datos['correo']);
        oci_bind_by_name($stmt, ":fecha", $datos['fecha_nacimiento']);

        return oci_execute($stmt);
    }
}
