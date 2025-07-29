<?php
session_start();

//Verificar si se enviaron los datos del formulario
if (!isset($_POST['usuario']) || !isset($_POST['contrasena'])) {
    header("Location: ../login.php?error=missing");
    exit;
}

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

//conectar a Oracle
$conn = oci_connect("FIDE_LENG_PROYECTO", "123", "localhost/XE");
if (!$conn) {
    $e = oci_error();
    die("❌ Error de conexión: " . $e['message']);
}

//Preparar la consulta
$stmt = oci_parse($conn, "BEGIN FIDE_VALIDAR_LOGIN_SP(:usuario, :contrasena, :existe); END;");
oci_bind_by_name($stmt, ":usuario", $usuario);
oci_bind_by_name($stmt, ":contrasena", $contrasena);
oci_bind_by_name($stmt, ":existe", $existe, 10);
oci_execute($stmt);

if ($existe == 1) {
    //inicio de sesion exitoso
    $_SESSION['usuario'] = $usuario;

    header("Location: ../index.php");
} else {
    //fallóo el inicio de sesión
    header("Location: ../login.php?error=invalid");
}

//Cerrar
oci_free_statement($stid);
oci_close($conn);
