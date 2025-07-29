<?php
function conectar() {
    $conn = oci_connect("FIDE_LENG_PROYECTO", "123", "localhost/XE");
    if (!$conn) {
        $e = oci_error();
        die("❌ Error de conexión: " . $e['message']);
    }
    return $conn;
}
?>