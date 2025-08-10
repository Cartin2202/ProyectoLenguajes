<?php
class ProductosModel {
    private $conn;

    public function __construct() {
        $this->conn = oci_connect("FIDE_LENG_PROYECTO", "123", "localhost/XE");
        if (!$this->conn) {
            $e = oci_error();
            die("❌ Error de conexión: " . $e['message']);
        }
    }

    public function obtenerProductos($id_categoria = null) {
        $productos = [];
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_PRODUCTO_TB_CONSULTAR_SP(:cursor, :categoria); END;");
        $cursor = oci_new_cursor($this->conn);

        oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);
        oci_bind_by_name($stmt, ":categoria", $id_categoria);

        oci_execute($stmt);
        oci_execute($cursor);

        while ($row = oci_fetch_assoc($cursor)) {
            $productos[] = $row;
        }

        oci_free_statement($stmt);
        oci_free_statement($cursor);

        return $productos;
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

    public function obtenerMateriales() {
        $materiales = [];
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_TIPO_MATERIAL_TB_LISTAR_SP(:cursor); END;");
        $cursor = oci_new_cursor($this->conn);

        oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($cursor);

        while ($row = oci_fetch_assoc($cursor)) {
            $materiales[] = $row;
        }

        oci_free_statement($stmt);
        oci_free_statement($cursor);

        return $materiales;
    }

    public function obtenerPesos() {
        $pesos = [];
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_PESO_PRODUCTOS_TB_LISTAR_SP(:cursor); END;");
        $cursor = oci_new_cursor($this->conn);

        oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($cursor);

        while ($row = oci_fetch_assoc($cursor)) {
            $pesos[] = $row;
        }

        oci_free_statement($stmt);
        oci_free_statement($cursor);

        return $pesos;
    }

    public function insertarProducto($nombre, $descripcion, $precio, $categoria, $material, $peso) {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_PRODUCTO_TB_INSERTAR_PRODUCTO_SP(:nombre, :descripcion, :precio, :categoria, :material, :peso); END;");
        oci_bind_by_name($stmt, ":nombre", $nombre);
        oci_bind_by_name($stmt, ":descripcion", $descripcion);
        oci_bind_by_name($stmt, ":precio", $precio);
        oci_bind_by_name($stmt, ":material", $material);
        oci_bind_by_name($stmt, ":peso", $peso);
        oci_bind_by_name($stmt, ":categoria", $categoria);
        oci_execute($stmt);
        oci_free_statement($stmt);
    }

    public function eliminarProducto($id) {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_PRODUCTO_TB_ELIMINAR_PRODUCTO_SP(:id); END;");
        oci_bind_by_name($stmt, ":id", $id);
        oci_execute($stmt);
        oci_free_statement($stmt);
    }

    public function obtenerProductoPorId($id) {
    $producto = null;
    $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_PRODUCTO_TB_CONSULTAR_POR_ID_SP(:id, :cursor); END;");
    $cursor = oci_new_cursor($this->conn);

    oci_bind_by_name($stmt, ":id", $id);
    oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);

    oci_execute($stmt);
    oci_execute($cursor);

    if ($row = oci_fetch_assoc($cursor)) {
        $producto = $row;
    }

    oci_free_statement($stmt);
    oci_free_statement($cursor);
    return $producto;
}

public function actualizarProducto($id, $nombre, $descripcion, $precio, $material, $peso, $categoria, $estado) {
    $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_PRODUCTO_TB_ACTUALIZAR_PRODUCTO_SP(:id, :nombre, :descripcion, :precio, :material, :peso, :categoria, :estado); END;");
    oci_bind_by_name($stmt, ":id", $id);
    oci_bind_by_name($stmt, ":nombre", $nombre);
    oci_bind_by_name($stmt, ":descripcion", $descripcion);
    oci_bind_by_name($stmt, ":precio", $precio);
    oci_bind_by_name($stmt, ":material", $material);
    oci_bind_by_name($stmt, ":peso", $peso);
    oci_bind_by_name($stmt, ":categoria", $categoria);
    oci_bind_by_name($stmt, ":estado", $estado);
    oci_execute($stmt);
    oci_commit($this->conn);
    oci_free_statement($stmt);
}

}
?>
