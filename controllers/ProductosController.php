<?php
require_once 'config/conexion.php';

class ProductosController
{
    private $conn;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->conn = $conexion->getConexion();
    }

    public function listarProductos($id_categoria = null)
    {
        $productos = [];
        $sql = "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_PRODUCTO_TB_CONSULTAR_SP(:cursor, :categoria); END;";
        $stmt = oci_parse($this->conn, $sql);
        $cursor = oci_new_cursor($this->conn);

        oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);
        oci_bind_by_name($stmt, ":categoria", $id_categoria);
        oci_execute($stmt);
        oci_execute($cursor);

        while ($row = oci_fetch_assoc($cursor)) {
            $productos[] = $row;
        }
        return $productos;
    }

    public function listarCategorias()
    {
        $stmt = oci_parse($this->conn, "SELECT ID_CATEGORIA, NOMBRE FROM FIDE_CATEGORIAS_TB WHERE ID_ESTADO = 1");
        oci_execute($stmt);
        $categorias = [];
        while ($row = oci_fetch_assoc($stmt)) {
            $categorias[] = $row;
        }
        return $categorias;
    }

    public function eliminarProducto($id)
    {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_PRODUCTO_TB_ELIMINAR_PRODUCTO_SP(:id); END;");
        oci_bind_by_name($stmt, ":id", $id);
        oci_execute($stmt);
    }

    public function insertarProducto($nombre, $descripcion, $precio, $categoria, $material, $peso)
    {
        $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_PRODUCTO_TB_INSERTAR_PRODUCTO_SP(:nombre, :descripcion, :precio, :categoria, :material, :peso); END;");
        oci_bind_by_name($stmt, ":nombre", $nombre);
        oci_bind_by_name($stmt, ":descripcion", $descripcion);
        oci_bind_by_name($stmt, ":precio", $precio);
        oci_bind_by_name($stmt, ":categoria", $categoria);
        oci_bind_by_name($stmt, ":material", $material);
        oci_bind_by_name($stmt, ":peso", $peso);
        oci_execute($stmt);
    }

    public function obtenerCategorias() {
    $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_CATEGORIAS_TB_LISTAR_SP(:cursor); END;");
    $cursor = oci_new_cursor($this->conn);
    oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);
    oci_execute($stmt);
    oci_execute($cursor);
    $categorias = [];
    while (($row = oci_fetch_assoc($cursor)) != false) {
        $categorias[] = $row;
    }
    return $categorias;
}

    public function obtenerMateriales()
{
    $materiales = [];
    $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_TIPO_MATERIAL_TB_LISTAR_SP(:cursor); END;");
    $cursor = oci_new_cursor($this->conn);

    oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);
    oci_execute($stmt);
    oci_execute($cursor);

    while ($row = oci_fetch_assoc($cursor)) {
        $materiales[] = $row;
    }
    return $materiales;
}

public function obtenerPesos()
{
    $pesos = [];
    $stmt = oci_parse($this->conn, "BEGIN FIDE_PIEDRAS_ENCHAPES_PKG.FIDE_PESO_PRODUCTOS_TB_LISTAR_SP(:cursor); END;");
    $cursor = oci_new_cursor($this->conn);

    oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);
    oci_execute($stmt);
    oci_execute($cursor);

    while ($row = oci_fetch_assoc($cursor)) {
        $pesos[] = $row;
    }
    return $pesos;
}
}
