<?php
// 1. Datos del formulario
$cedula = $_POST['cedula'];
$nombre = $_POST['nombre'];
$primer_apellido = $_POST['primer_apellido'];
$segundo_apellido = $_POST['segundo_apellido'];
$nombre_usuario = $_POST['nombre_usuario'];
$contrasena = $_POST['contrasena'];
$correo = $_POST['correo'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$salario = $_POST['salario'];
$id_puesto_usuario = $_POST['id_puesto_usuario'];
$id_tipo_usuario = $_POST['id_tipo_usuario'];
$id_rol_usuario = $_POST['id_rol_usuario'];
$id_estado = $_POST['id_estado'];

// 2. Conexión con Oracle
$conn = oci_connect("FIDE_LENG_PROYECTO", "123", "localhost/XE");
if (!$conn) {
    $e = oci_error();
    die("Error de conexión: " . $e['message']);
}

// 3. Preparar SQL (INSERT)
$sql = "INSERT INTO FIDE_LENG_PROYECTO.FIDE_USUARIOS_TB (
            cedula, nombre, primer_apellido, segundo_apellido,
            nombre_usuario, contraseña, correo, fecha_nacimiento,
            fecha_registro, salario, id_puesto_usuario, id_tipo_usuario,
            id_rol_usuario, id_estado
        ) VALUES (
            :cedula, :nombre, :primer_apellido, :segundo_apellido,
            :nombre_usuario, :contrasena, :correo, TO_DATE(:fecha_nacimiento, 'YYYY-MM-DD'),
            SYSDATE, :salario, :id_puesto_usuario, :id_tipo_usuario,
            :id_rol_usuario, :id_estado
        )";

$stid = oci_parse($conn, $sql);

// 4. Asociar valores
oci_bind_by_name($stid, ":cedula", $cedula);
oci_bind_by_name($stid, ":nombre", $nombre);
oci_bind_by_name($stid, ":primer_apellido", $primer_apellido);
oci_bind_by_name($stid, ":segundo_apellido", $segundo_apellido);
oci_bind_by_name($stid, ":nombre_usuario", $nombre_usuario);
oci_bind_by_name($stid, ":contrasena", $contrasena);
oci_bind_by_name($stid, ":correo", $correo);
oci_bind_by_name($stid, ":fecha_nacimiento", $fecha_nacimiento);
oci_bind_by_name($stid, ":salario", $salario);
oci_bind_by_name($stid, ":id_puesto_usuario", $id_puesto_usuario);
oci_bind_by_name($stid, ":id_tipo_usuario", $id_tipo_usuario);
oci_bind_by_name($stid, ":id_rol_usuario", $id_rol_usuario);
oci_bind_by_name($stid, ":id_estado", $id_estado);

// 5. Ejecutar
$r = oci_execute($stid);
if ($r) {
    echo "✅ Usuario registrado con éxito.";
} else {
    $e = oci_error($stid);
    echo "❌ Error al insertar: " . $e['message'];
}
//si se registra correctamente el usuario:
if ($r) {
    //se muestra mensaje de EXITO con botón de continuar
    echo '
    <div style="text-align:center; margin-top: 50px; font-family: sans-serif;">
        <h2 style="color: green;">✅ Usuario registrado con éxito.</h2>
        <a href="../index.php" style="display:inline-block; margin-top: 20px; padding: 10px 20px; background-color:#343a40; color:white; text-decoration:none; border-radius:5px;">Continuar</a>
    </div>';
} else {
    $e = oci_error($stid);
    echo "<h2 style='color:red; text-align:center; margin-top:50px;'>❌ Error al insertar: " . $e['message'] . "</h2>";
}


// 6. Cerrar conexión
oci_free_statement($stid);
oci_close($conn);
?>
