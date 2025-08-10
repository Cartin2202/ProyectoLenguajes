<?php
class Conexion {
    private $conn;

    public function __construct() {
        $username = "FIDE_LENG_PROYECTO";
        $password = "123";
        $connection_string = "localhost/XE";

        $this->conn = oci_connect($username, $password, $connection_string);

        if (!$this->conn) {
            $e = oci_error();
            throw new Exception("Error de conexión: " . $e['message']);
        }
    }

    public function getConexion() {
        return $this->conn;
    }
}
?>
