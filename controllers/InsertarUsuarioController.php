<?php
require_once __DIR__ . '/../models/RegistroModel.php';

$model = new RegistroModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$resultado = $model->insertarUsuarioCliente($_POST);

    if ($resultado) {
        echo '
        <div style="text-align:center; margin-top: 50px; font-family: sans-serif;">
            <h2 style="color: green;">✅ Usuario registrado con éxito.</h2>
            <a href="../index.php" style="display:inline-block; margin-top: 20px; padding: 10px 20px; background-color:#343a40; color:white; text-decoration:none; border-radius:5px;">Continuar</a>
        </div>';
    } else {
        echo "<h2 style='color:red; text-align:center; margin-top:50px;'>❌ Error al registrar el usuario.</h2>";
    }
}
?>
