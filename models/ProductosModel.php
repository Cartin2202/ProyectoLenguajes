<?php
//clase de los productos
class ProductosModel {
    private $conn; 

    //construct que se ejecuta al instanciar la clase
    public function __construct() {
        $this->conn = oci_connect("FIDE_LENG_PROYECTO", "123", "localhost/XE");

        if (!$this->conn) {
            $e = oci_error();
            die("Error de conexión: " . $e['message']);
        }
    }

    //funcion para ver las categorias activas
    public function obtenerCategoriasActivas() {
        $sql = "SELECT ID_CATEGORIA, NOMBRE FROM FIDE_CATEGORIAS_TB WHERE ID_ESTADO = 1"; 
        $stmt = oci_parse($this->conn, $sql); 
        oci_execute($stmt); 

        $categorias = []; //se guardan las categorias

        //se agrean al arreglo en base  al resultado
        while ($row = oci_fetch_assoc($stmt)) {
            $categorias[] = $row;
        }

        oci_free_statement($stmt); 

        return $categorias; 
    }

    //funcion para poder tener los productos filtrandolos por categorias
    public function obtenerProductosFiltrados() {
        $filtro = isset($_GET['categoria']) ? intval($_GET['categoria']) : 0;
        $productos = []; //se guardan los productos

        // se llama al prodecure en ORACLE
        $stmt = oci_parse($this->conn, "BEGIN FIDE_OBTENER_PRODUCTOS_SP(:p_categoria, :p_cursor); END;");
        $cursor = oci_new_cursor($this->conn); //cursor para los resultados

        //relaicona los parametros al procedure
        oci_bind_by_name($stmt, ":p_categoria", $filtro);
        oci_bind_by_name($stmt, ":p_cursor", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);   
        oci_execute($cursor); 

        // guarda los resultados del cursor en el arreglo
        while ($row = oci_fetch_assoc($cursor)) {
            $productos[] = $row;
        }

        oci_free_statement($stmt);
        oci_free_statement($cursor);
        oci_close($this->conn);

        return $productos; 
    }
}
