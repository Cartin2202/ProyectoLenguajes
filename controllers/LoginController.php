<?php
session_start();
require_once '../models/LoginModel.php';

if (!isset($_POST['usuario']) || !isset($_POST['contrasena'])) {
    header("Location: ../views/login.php?error=missing");
    exit;
}

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

if (LoginModel::validarCredenciales($usuario, $contrasena)) {
    $_SESSION['usuario'] = $usuario;
    header("Location: ../index.php");
} else {
    header("Location: ../views/login.php?error=invalid");
}
?>
