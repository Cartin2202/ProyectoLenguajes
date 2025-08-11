<?php
class LoginModel {
    public static function validarCredenciales($usuario, $contrasena) {
        $conn = oci_connect("FIDE_LENG_PROYECTO", "123", "localhost/XE");
        if (!$conn) {
            $e = oci_error();
            die("❌ Error de conexión: " . $e['message']);
        }

        $stmt = oci_parse($conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_VALIDAR_LOGIN_SP(:usuario, :contrasena, :existe); END;");
        oci_bind_by_name($stmt, ":usuario", $usuario);
        oci_bind_by_name($stmt, ":contrasena", $contrasena);
        oci_bind_by_name($stmt, ":existe", $existe, 10);

        oci_execute($stmt);
        oci_free_statement($stmt);
        oci_close($conn);

        return $existe == 1;
    }

    public function obtenerInformacionUsuario($usuario, $contrasena) {
        $conn = oci_connect("FIDE_LENG_PROYECTO", "123", "localhost/XE");
        if (!$conn) {
            $e = oci_error();
            die("❌ Error de conexión: " . $e['message']);
        }

        $stmt = oci_parse($conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_USUARIOS_TB_VALIDAR_INFORMACION_SP(:usuario, :contrasena, :cursor); END;");
        $cursor = oci_new_cursor($conn);

        oci_bind_by_name($stmt, ":usuario", $usuario);
        oci_bind_by_name($stmt, ":contrasena", $contrasena);
        oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($cursor);

        $resultado = oci_fetch_assoc($cursor);

        oci_free_statement($stmt);
        oci_free_statement($cursor);
        oci_close($conn);

        return $resultado ?: false;
    }

}
?>
