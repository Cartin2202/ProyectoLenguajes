<?php
class CategoriasModel {
    private $conn;

    public function __construct() {
        $this->conn = oci_connect("FIDE_LENG_PROYECTO", "123", "localhost/XE");
        if (!$this->conn) {
            $e = oci_error();
            die("❌ Error de conexión: " . $e['message']);
        }
    }

    public function obtenerCategorias() {
        $categorias = [];
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_CATEGORIAS_TB_LISTAR_SP(:cursor); END;");
        $cursor = oci_new_cursor($this->conn);
        oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($cursor);

        while ($row = oci_fetch_assoc($cursor)) {
            $categorias[] = $row;
        }

        oci_free_statement($stmt);
        oci_free_statement($cursor);
        return $categorias;
    }

    public function insertarCategoria($nombre, $descripcion) {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_CATEGORIAS_TB_INSERTAR_CATEGORIA_SP(:nombre, :descripcion); END;");
        oci_bind_by_name($stmt, ":nombre", $nombre);
        oci_bind_by_name($stmt, ":descripcion", $descripcion);

        oci_execute($stmt);
        oci_commit($this->conn);
        oci_free_statement($stmt);
    }

    public function obtenerCategoriaPorId($id) {
        $stmt = oci_parse($this->conn, "SELECT ID_CATEGORIA, NOMBRE, DESCRIPCION, ID_ESTADO FROM FIDE_CATEGORIAS_TB WHERE ID_CATEGORIA = :id");
        oci_bind_by_name($stmt, ":id", $id);
        oci_execute($stmt);

        $categoria = oci_fetch_assoc($stmt);
        oci_free_statement($stmt);
        return $categoria;
    }

    public function actualizarCategoria($id, $nombre, $descripcion, $estado) {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_CATEGORIAS_TB_ACTUALIZAR_CATEGORIA_SP(:id, :nombre, :descripcion, :estado); END;");
        oci_bind_by_name($stmt, ":id", $id);
        oci_bind_by_name($stmt, ":nombre", $nombre);
        oci_bind_by_name($stmt, ":descripcion", $descripcion);
        oci_bind_by_name($stmt, ":estado", $estado);

        oci_execute($stmt);
        oci_commit($this->conn);
        oci_free_statement($stmt);
    }

    public function eliminarCategoria($id) {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_CATEGORIAS_TB_ELIMINAR_CATEGORIA_SP(:id); END;");
        oci_bind_by_name($stmt, ":id", $id);

        oci_execute($stmt);
        oci_commit($this->conn);
        oci_free_statement($stmt);
    }
}
?>
